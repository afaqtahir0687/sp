<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderPlaced;
use App\Mail\OrderStatusUpdated;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'address' => 'required|string',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
            'zip_code' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'payment_method' => 'required|in:cod',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty.');
        }

        // Calculate totals — same logic as cart & checkout
        $subtotal       = 0;
        $total_discount = 0;
        foreach ($cart as $id => $details) {
            $qty             = (int) ($details['quantity'] ?? 1);
            $unit_price      = (float) ($details['price'] ?? 0);
            $unit_orig_price = (float) ($details['original_price'] ?? $unit_price);

            $item_original_total = $unit_orig_price * $qty;
            $item_selling_total  = $unit_price * $qty;

            $subtotal       += $item_original_total;
            $total_discount += ($item_original_total - $item_selling_total);
        }

        $after_discount = $subtotal - $total_discount;
        $tax            = round($after_discount * 0.15, 2); // 15% VAT
        $grand_total    = round($after_discount + $tax, 2);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'order_number' => 'ORD-' . strtoupper(Str::random(10)),
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'company_name' => $request->company_name,
                'country_id' => $request->country,
                'state_id' => $request->state,
                'city_id' => $request->city,
                'address' => $request->address,
                'zip_code' => $request->zip_code,
                'phone' => $request->phone,
                'email' => $request->email,
                'notes' => $request->notes,
                'subtotal' => $subtotal,
                'discount' => $total_discount,
                'tax' => $tax,
                'shipping' => 0,
                'grand_total' => $grand_total,
                'payment_method' => $request->payment_method,
                'payment_status' => 'pending',
                'order_status' => 'pending',
            ]);

            foreach ($cart as $id => $details) {
                $type = $details['type'] ?? 'product';
                $productId = null;
                $blankProductId = null;
                $bookId = null;
                $options = $details['options'] ?? [];

                if ($type === 'blank') {
                    $blankProductId = $details['blank_product_id'] ?? null;
                } elseif ($type === 'book') {
                    $bookId = $details['book_id'] ?? null;
                } else {
                    $productId = $details['product_id'] ?? null;
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $productId,
                    'blank_product_id' => $blankProductId,
                    'book_id' => $bookId,
                    'type' => $type,
                    'product_name' => $details['name'],
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                    'total' => $details['price'] * $details['quantity'],
                    'production_days' => $options['production_days'] ?? null,
                    'delivery_days' => $options['delivery_days'] ?? null,
                    'options' => is_array($options) ? json_encode($options) : $options,
                ]);
            }

            DB::commit();
            session()->forget('cart');


            // Send Order Confirmation Email
            try {
                $order->load('items'); // Ensure items are loaded
                \Log::info('Attempting to send order email for order: ' . $order->order_number . ' to: ' . $order->email);
                if (empty($order->email)) {
                    \Log::error('Order email is empty for order: ' . $order->order_number);
                } else {
                    Mail::to($order->email)->send(new OrderPlaced($order));
                    \Log::info('Order email sent successfully for order: ' . $order->order_number);
                }
            } catch (\Exception $e) {
                // Log error but don't fail the order if email fails
                \Log::error('Order email failed: ' . $e->getMessage() . ' Trace: ' . $e->getTraceAsString());
            }
            
            return redirect()->route('order.complete')
                ->with('success', 'Order placed successfully!')
                ->with('order_number', $order->order_number)
                ->with('grand_total', $order->grand_total)
                ->with('payment_method', $order->payment_method);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong while placing your order. ' . $e->getMessage());
        }
    }
    public function cancel($id)
    {
        $order = Order::where('user_id', auth()->id())->findOrFail($id);

        if ($order->order_status !== 'pending') {
            return redirect()->back()->with('error', 'Only pending orders can be cancelled.');
        }

        $createdAt = \Carbon\Carbon::parse($order->created_at);
        $diffInMinutes = $createdAt->diffInMinutes(now());

        $refundMessage = "";
        
        // Check if payment was made
        if ($order->payment_status === 'paid') {
            if ($diffInMinutes <= 5) {
                // 75% Refund (25% deduction)
                $refundAmount = $order->grand_total * 0.75;
                $order->payment_status = 'refund_pending';
                $order->notes = ($order->notes ? $order->notes . "\n" : "") . "Cancellation within 5 mins. 75% refund initiated: " . $refundAmount;
                $refundMessage = " Since you cancelled within 5 minutes, a 75% refund is being processed.";
            } else {
                // No Refund
                $order->payment_status = 'non_refundable';
                $order->notes = ($order->notes ? $order->notes . "\n" : "") . "Cancellation after 5 mins. No refund provided as per our 5-minute cancellation policy.";
                $refundMessage = " As per our policy, cancellations after 5 minutes are non-refundable.";
            }
        }

        $order->order_status = 'cancelled';
        $order->save();

        // Send Email Notification
        try {
            Mail::to($order->email)->send(new OrderStatusUpdated($order, 'cancelled'));
        } catch (\Exception $e) {
            \Log::error("Failed to send order cancellation email for order #{$order->order_number}: " . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Order cancelled successfully.' . $refundMessage);
    }
}
