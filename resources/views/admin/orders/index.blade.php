@extends('admin.layouts.master')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Orders List</h6>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Order #</th>
                        <th>Customer</th>
                        <th>Items</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                        <td>
                            <small>
                                @foreach($order->items as $item)
                                    <div>
                                        {{ $item->product_name }}
                                        @if($item->type === 'blank')
                                            <span class="badge badge-info">Blank</span>
                                            @if($item->options)
                                                @php
                                                    $itemOptions = is_string($item->options) ? json_decode($item->options, true) : $item->options;
                                                @endphp
                                                @if(is_array($itemOptions) && (isset($itemOptions['size']) || isset($itemOptions['color'])))
                                                    <span class="text-muted">
                                                        @if(isset($itemOptions['size'])) ({{ $itemOptions['size'] }}) @endif
                                                        @if(isset($itemOptions['color'])) - {{ $itemOptions['color'] }} @endif
                                                    </span>
                                                @endif
                                            @endif
                                        @endif
                                    </div>
                                @endforeach
                            </small>
                        </td>
                        <td>{{ format_price($order->grand_total) }}</td>
                        <td>
                            @php
                                $status_class = [
                                    'pending' => 'warning',
                                    'processing' => 'info',
                                    'completed' => 'success',
                                    'cancelled' => 'danger'
                                ][$order->order_status] ?? 'secondary';
                            @endphp
                            <span class="badge badge-{{ $status_class }}">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-info btn-sm">View</a>
                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('styles')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "order": [[ 5, "desc" ]]
            });
        });
    </script>
@endpush

