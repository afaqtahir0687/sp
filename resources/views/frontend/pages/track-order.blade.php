@extends('frontend.layouts.master')
@section('title', __('track_order.title'))

@section('content')
    <style>
        .track-page-header {
            background-color: #f8f9fa;
            padding: 40px 0;
            margin-bottom: 0;
            border-bottom: 1px solid #e9ecef;
        }
        .track-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: transform 0.3s ease;
        }
        .track-card:hover {
            transform: translateY(-5px);
        }
        .track-card .card-body {
            padding: 3rem;
        }
        .track-title {
            font-weight: 700;
            color: #333;
            margin-bottom: 10px;
            letter-spacing: -0.5px;
        }
        .track-subtitle {
            color: #6c757d;
            margin-bottom: 30px;
            font-size: 0.95rem;
        }
        .form-control-custom {
            height: 50px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            padding-left: 15px;
            font-size: 15px;
            transition: all 0.2s;
        }
        .form-control-custom:focus {
            border-color: #2596be;
            box-shadow: 0 0 0 3px rgba(37, 150, 190, 0.1);
        }
        .btn-custom-primary {
            background-color: #2596be;
            border-color: #2596be;
            color: white;
            height: 50px;
            border-radius: 8px;
            font-weight: 600;
            letter-spacing: 0.5px;
            font-size: 16px;
            box-shadow: 0 4px 6px rgba(37, 150, 190, 0.2);
            transition: all 0.3s;
        }
        .btn-custom-primary:hover {
            background-color: #d61c84;
            border-color: #d61c84;
            transform: translateY(-2px);
            box-shadow: 0 6px 12px rgba(37, 150, 190, 0.3);
            color: white;
        }
        .form-label-custom {
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 8px;
            font-size: 14px;
        }
        .required-asterisk {
            color: #e53e3e;
        }

        /* Table Styles */
        .order-details-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-top: 40px;
        }
        .table-custom thead th {
            background-color: #f8fafc;
            border-bottom: 2px solid #edf2f7;
            color: #4a5568;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 0.05em;
            padding: 15px;
        }
        .table-custom td {
            padding: 18px 15px;
            vertical-align: middle;
            color: #2d3748;
            border-bottom: 1px solid #edf2f7;
        }
        .order-status-badge {
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .products-list {
            min-width: 300px;
        }
        .countdown-box {
            background: linear-gradient(135deg, #2596be 0%, #1a7a99 100%);
            color: white;
            min-width: 70px;
            box-shadow: 0 4px 15px rgba(37, 150, 190, 0.3);
            padding: 6px;
            border-radius: 12px;
        }
    </style>

    <div class="page-header track-page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">{{ __('header.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('track_order.track_order') }}</li>
                    </ol>
                </div>
            </nav>
            <h1>{{ __('track_order.track_your_order') }}</h1>
        </div>
    </div>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center px-3 px-md-0">
            <div class="col-lg-5 col-md-8">
                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mb-4 rounded-lg" role="alert">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card track-card">
                    <div class="card-body">
                        <div class="text-center">
                            <h2 class="track-title">{{ __('track_order.order_tracking') }}</h2>
                            <p class="track-subtitle">{{ __('track_order.enter_details') }}</p>
                        </div>

                        <form method="POST" action="{{ route('track.order.post') }}" id="track-order-form">
                            @csrf
                            <div class="form-group mb-4">
                                <label for="order_number" class="form-label-custom">
                                    {{ __('track_order.order_number') }} <span class="required-asterisk">*</span>
                                </label>
                                <input type="text"
                                       class="form-control form-control-custom @error('order_number') is-invalid @enderror"
                                       id="order_number"
                                       name="order_number"
                                       value="{{ old('order_number', request('order_number')) }}"
                                       required
                                       placeholder="{{ __('track_order.order_number_placeholder') }}"
                                       autocomplete="off" />
                                @error('order_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mb-4">
                                <label for="email" class="form-label-custom">
                                    {{ __('track_order.email_address') }} <span class="required-asterisk">*</span>
                                </label>
                                <input type="email"
                                       class="form-control form-control-custom @error('email') is-invalid @enderror"
                                       id="email"
                                       name="email"
                                       value="{{ old('email', request('email')) }}"
                                       required
                                       placeholder="{{ __('track_order.registered_email') }}"
                                       autocomplete="email" />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group mt-5">
                                <button type="submit" class="btn btn-custom-primary btn-block" id="track-btn">
                                    <span class="spinner-border spinner-border-sm d-none mr-2" role="status" aria-hidden="true" id="track-spinner"></span>
                                    <span class="btn-text">{{ __('track_order.track_my_order') }}</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Order Details Section -->
        @if($order)
        <div class="row justify-content-center mt-5 px-3 px-md-0">
            <div class="col-lg-12">
                <div class="card order-details-card">
                    <div class="card-body p-0">
                        <div class="p-4 border-bottom">
                            <h3 class="mb-0 font-weight-bold" style="font-size: 1.25rem;">{{ __('track_order.order_results') }}</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-custom mb-0">
                                <thead>
                                    <tr>
                                        <th>{{ __('track_order.order_id') }}</th>
                                        <th>{{ __('track_order.date') }}</th>
                                        <th>{{ __('cart.product') }}</th>
                                        <th>{{ __('cart.order_total') }}</th>
                                        <th>{{ __('track_order.status') }}</th>
                                        <th>{{ __('track_order.address') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">{{ $order->order_number }}</td>
                                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <div class="products-list">
                                                @foreach($order->items as $item)
                                                    <div class="product-item mb-3 p-3 border rounded shadow-sm bg-white">
                                                        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
                                                            <div class="product-info mb-2 mb-md-0">
                                                                <h5 class="mb-1 font-weight-bold text-dark" style="font-size: 1.1rem;">
                                                                    <i class="fas fa-box-open mr-2 text-primary"></i>{{ $item->product_name }}
                                                                </h5>
                                                                <span class="badge badge-light border">{{ __('track_order.quantity') }}: {{ $item->quantity }}</span>
                                                            </div>
                                                            <div class="delivery-status">
                                                                @if($item->production_days !== null && $item->delivery_days !== null)
                                                                    @php
                                                                        $totalDays = (int)$item->production_days + (int)$item->delivery_days;
                                                                        $daysPassed = (int)$order->created_at->diffInDays(now());
                                                                        $remainingDays = (int)max(0, $totalDays - $daysPassed);
                                                                    @endphp
                                                                    <div class="countdown-box text-center">
                                                                        @if($remainingDays > 0)
                                                                            <div class="d-flex flex-column align-items-center">
                                                                                <span class="font-weight-bold" style="font-size: 2rem; line-height: 1;">{{ $remainingDays }}</span>
                                                                                <span class="text-uppercase font-weight-bold" style="font-size: 0.7rem; letter-spacing: 1px;">{{ Str::plural(__('track_order.day'), $remainingDays) }} {{ __('track_order.left') }}</span>
                                                                            </div>
                                                                        @else
                                                                            <div class="d-flex flex-column align-items-center">
                                                                                <i class="fas fa-check-circle mb-1" style="font-size: 1.2rem;"></i>
                                                                                <span class="text-uppercase font-weight-bold" style="font-size: 0.8rem;">{{ __('track_order.arrived') }}</span>
                                                                            </div>
                                                                        @endif
                                                                    </div>
                                                                @else
                                                                    <div class="text-center p-3 bg-secondary rounded text-white" style="min-width: 130px;">
                                                                        <i class="fas fa-sync fa-spin mb-1" style="font-size: 1.2rem;"></i>
                                                                        <div class="small font-weight-bold text-uppercase">{{ __('track_order.processing') }}</div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </td>
                                        <td class="font-weight-bold text-primary">{{ format_price($order->grand_total) }}</td>
                                        <td>
                                            @php
                                                $badgeClass = 'secondary';
                                                if($order->order_status == 'pending') $badgeClass = 'warning';
                                                if($order->order_status == 'processing') $badgeClass = 'info';
                                                if($order->order_status == 'completed') $badgeClass = 'success';
                                                if($order->order_status == 'cancelled') $badgeClass = 'danger';
                                            @endphp
                                            <span class="badge order-status-badge badge-{{ $badgeClass }}">{{ ucfirst($order->order_status) }}</span>
                                        </td>
                                        <td style="font-size: 0.9rem;">
                                            {{ $order->first_name }} {{ $order->last_name }}<br>
                                            <span class="text-muted">{{ $order->address }}</span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @elseif(request()->isMethod('post'))
            <div class="row justify-content-center mt-5 px-3 px-md-0">
                <div class="col-lg-6 text-center">
                    <div class="p-5 bg-white shadow-sm rounded-lg border">
                        <i class="fas fa-search-minus fa-3x mb-3 text-muted"></i>
                        <h4 class="text-muted">{{ __('track_order.order_not_found') }}</h4>
                        <p class="mb-0">{{ __('track_order.check_details') }}</p>
                    </div>
                </div>
            </div>
        @endif
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const trackForm = document.getElementById('track-order-form');
            const trackBtn = document.getElementById('track-btn');
            const trackSpinner = document.getElementById('track-spinner');
            const btnText = trackBtn ? trackBtn.querySelector('.btn-text') : null;

            if (trackForm && trackBtn) {
                trackForm.addEventListener('submit', function() {
                    if (this.checkValidity()) {
                        trackBtn.disabled = true;
                        if (trackSpinner) trackSpinner.classList.remove('d-none');
                        if (btnText) btnText.textContent = '{{ __('track_order.tracking') }}';
                    }
                });
            }
        });
    </script>
    @endpush
@endsection

