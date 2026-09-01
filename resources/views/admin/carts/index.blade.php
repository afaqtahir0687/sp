@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Active User Carts</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Product</th>
                            <th>Designs (Qty)</th>
                            <th>Print Qty</th>
                            <th>Urgency</th>
                            <th>Price</th>
                            <th>Production</th>
                            <th>Delivery</th>
                            <th>Added At</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach($carts as $cart)
                        <tr>
                            <td>{{ $cart->user ? $cart->user->username : 'Guest/Unknown' }} 
                                <br><small class="text-muted">{{ $cart->user ? $cart->user->email : '' }}</small>
                            </td>
                            <td>
                                @if($cart->product)
                                    <div class="d-flex align-items-center">
                                        @if($cart->product->image)
                                            <img src="{{ Storage::url($cart->product->image) }}" alt="" width="40" class="mr-2 rounded">
                                        @endif
                                        <span>{{ $cart->product->name }}</span>
                                    </div>
                                @else
                                    <span class="text-danger">Product Deleted</span>
                                @endif
                            </td>
                            <td>{{ $cart->quantity }}</td>
                            <td>{{ $cart->print_quantity }}</td>
                            <td>
                                <span class="badge badge-{{ $cart->urgency == 'urgent' ? 'danger' : ($cart->urgency == 'flexible' ? 'info' : 'secondary') }}">
                                    {{ ucfirst($cart->urgency) }}
                                </span>
                            </td>
                            <td>{{ format_price($cart->price) }}</td>
                            <td>{{ $cart->production_days }} Days</td>
                            <td>{{ $cart->delivery_days }} Days</td>
                            <td>{{ $cart->created_at->diffForHumans() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

