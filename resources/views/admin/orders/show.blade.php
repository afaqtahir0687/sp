@extends('admin.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Order ID: {{ $order->order_number }}</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    @if($item->type === 'blank' && $item->blankProduct && $item->blankProduct->image)
                                        <img src="{{ asset('storage/app/public/' . $item->blankProduct->image) }}" alt="{{ $item->product_name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                    @elseif($item->type === 'product' && $item->product && $item->product->image)
                                        <img src="{{ asset('storage/app/public/' . $item->product->image) }}" alt="{{ $item->product_name }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <div style="width: 60px; height: 60px; background: #f0f0f0; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #999; font-size: 12px;">No Image</div>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $item->product_name }}</strong>
                                        @if($item->type === 'blank')
                                            <span class="badge badge-info ml-2">Blank Product</span>
                                        @else
                                            <span class="badge badge-secondary ml-2">Regular Product</span>
                                        @endif
                                    </div>
                                    @if($item->type === 'blank' && $item->blankProduct)
                                        <small class="text-muted">
                                            @if(isset($item->blankProduct->sku)) SKU: {{ $item->blankProduct->sku }} @endif
                                        </small>
                                    @elseif($item->type === 'product' && $item->product)
                                        <small class="text-muted">
                                            @if(isset($item->product->sku)) SKU: {{ $item->product->sku }} @endif
                                        </small>
                                    @endif
                                    @if($item->options)
                                        @php
                                            $itemOptions = is_string($item->options) ? json_decode($item->options, true) : $item->options;
                                        @endphp
                                        @if(is_array($itemOptions))
                                            <div class="small text-muted mt-1">
                                            @foreach($itemOptions as $key => $value)
                                                @if(!in_array($key, ['production_days', 'delivery_days']) && !is_null($value) && $value !== '')
                                                    <div><strong style="text-transform: capitalize;">{{ str_replace('_', ' ', $key) }}:</strong> {{ is_array($value) ? implode(', ', $value) : $value }}</div>
                                                @endif
                                            @endforeach
                                            </div>
                                        @endif
                                    @endif
                                    @if($item->production_days || $item->delivery_days)
                                        <div class="small text-muted mt-1">
                                            @if($item->production_days) Production: {{ $item->production_days }} days @endif
                                            @if($item->delivery_days) | Delivery: {{ $item->delivery_days }} days @endif
                                        </div>
                                    @endif
                                </td>
                                <td>{{ format_price($item->price) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ format_price($item->total) }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-right">Subtotal</th>
                                <td>{{ format_price($order->subtotal) }}</td>
                            </tr>
                            @if($order->discount > 0)
                            <tr>
                                <th colspan="3" class="text-right text-danger">Discount</th>
                                <td class="text-danger">-{{ format_price($order->discount) }}</td>
                            </tr>
                            @endif
                            <tr>
                                <th colspan="3" class="text-right">Tax (15%)</th>
                                <td>{{ format_price($order->tax) }}</td>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-right">Grand Total</th>
                                <th class="text-primary">{{ format_price($order->grand_total) }}</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Notes</h6>
            </div>
            <div class="card-body">
                {{ $order->notes ?: 'No notes provided' }}
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Update Status</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>Order Status</label>
                        <select name="order_status" class="form-control">
                            <option value="pending" {{ $order->order_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->order_status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="completed" {{ $order->order_status == 'completed' ? 'selected' : '' }}>Completed</option>
                            <option value="cancelled" {{ $order->order_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Status</label>
                        <select name="payment_status" class="form-control">
                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Update Status</button>
                </form>
            </div>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Customer Information</h6>
            </div>
            <div class="card-body">
                <p><strong>Name:</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
                <p><strong>Email:</strong> {{ $order->email }}</p>
                <p><strong>Phone:</strong> {{ $order->phone }}</p>
                <p><strong>Address:</strong><br>
                    {{ $order->address }}<br>
                    {{ $order->city->name ?? '' }}, {{ $order->state->name ?? '' }} {{ $order->zip_code }}<br>
                    {{ $order->country->name ?? '' }}
                </p>
                <hr>
                <p><strong>Payment Method:</strong> <span class="text-uppercase">{{ str_replace('_', ' ', $order->payment_method) }}</span></p>
            </div>
        </div>
    </div>
</div>
@endsection

