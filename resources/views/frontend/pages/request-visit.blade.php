@extends('frontend.layouts.master')
@section('title', __('request_visit.title'))
@section('meta_description', __('request_visit.meta_description'))
@section('content')
<main class="main">
    <div class="page-header">
        <div class="container d-flex flex-column align-items-center">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <div class="container">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">{{ __('header.home') }}</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ __('request_visit.title') }}</li>
                    </ol>
                </div>
            </nav>
            <h1>{{ __('request_visit.title') }}</h1>
        </div>
    </div>

    <div class="container contact-us-container">
        <div class="contact-info">
            <div class="row">
                <div class="col-md-6 mb-8 mb-md-0">
                    <h2 class="font-weight-bold ls-n-10 text-uppercase mb-3 mt-5">{{ __('request_visit.subtitle') }}</h2>
                    <p class="mb-4 text-justify">{{ __('request_visit.description') }}</p>
                    
                    <div class="contact-details mt-5">
                        <h4 class="mt-4 mb-2">{{ __('request_visit.office_details') }}</h4>
                        @if($setting)
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-map-marker-alt text-primary mr-3" style="font-size: 24px;"></i>
                                <span>{{ $setting->address ?? 'King Fahd Road, Riyadh, Saudi Arabia' }}</span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-phone-alt text-primary mr-3" style="font-size: 24px;"></i>
                                <span><a href="tel:{{ $setting->phone ?? '+966 12 345 6789' }}" class="text-dark">{{ $setting->phone ?? '+966 12 345 6789' }}</a></span>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-envelope text-primary mr-3" style="font-size: 24px;"></i>
                                <span><a href="mailto:{{ $setting->email ?? 'info@crelogics.com' }}" class="text-dark">{{ $setting->email ?? 'info@crelogics.com' }}</a></span>
                            </div>
                        @else
                            <p>{{ __('request_visit.contact_unavailable') }}</p>
                        @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <h2 class="font-weight-bold ls-n-10 text-uppercase mb-3 mt-5">{{ __('request_visit.fill_form') }}</h2>

                    <form action="{{ route('request.visit.submit') }}" method="POST" class="contact-form mb-3">
                        @csrf
                        
                        <div class="form-group mb-3">
                            <label for="full_name">{{ __('request_visit.full_name') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                            @error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="email">{{ __('request_visit.email_address') }} <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label for="mobile_number">{{ __('request_visit.mobile_number') }} <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" required>
                                    @error('mobile_number') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="address">{{ __('request_visit.address') }} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}" required>
                            @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label>{{ __('request_visit.preferred_datetime') }} <span class="text-danger">*</span></label>
                            <div id="dates-container">
                                @if(old('preferred_dates'))
                                    @foreach(old('preferred_dates') as $index => $date)
                                        <div class="d-flex mb-2 date-row">
                                            <input type="datetime-local" class="form-control mr-2" name="preferred_dates[]" value="{{ $date }}" required>
                                            @if($index > 0)
                                                <button type="button" class="btn btn-danger btn-sm remove-date"><i class="fas fa-times"></i></button>
                                            @endif
                                        </div>
                                    @endforeach
                                @else
                                    <div class="d-flex mb-2 date-row">
                                        <input type="datetime-local" class="form-control mr-2" name="preferred_dates[]" required>
                                    </div>
                                @endif
                            </div>
                            <button type="button" id="add-more-dates" class="btn btn-sm btn-outline-primary mt-2"><i class="fas fa-plus"></i> {{ __('request_visit.add_more_datetime') }}</button>
                            @error('preferred_dates') <small class="text-danger d-block mt-1">{{ $message }}</small> @enderror
                        </div>

                        <div class="form-group mb-4">
                            <label for="message">{{ __('request_visit.message_requirements') }}</label>
                            <textarea class="form-control" id="message" name="message" rows="4">{{ old('message') }}</textarea>
                            @error('message') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100 p-3" style="font-size: 16px;">{{ __('request_visit.submit_request') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addBtn = document.getElementById('add-more-dates');
        const container = document.getElementById('dates-container');

        addBtn.addEventListener('click', function() {
            const row = document.createElement('div');
            row.className = 'd-flex mb-2 date-row';
            row.innerHTML = `
                <input type="datetime-local" class="form-control mr-2" name="preferred_dates[]" required>
                <button type="button" class="btn btn-danger btn-sm remove-date" title="Remove"><i class="fas fa-times"></i></button>
            `;
            container.appendChild(row);
        });

        container.addEventListener('click', function(e) {
            if (e.target.closest('.remove-date')) {
                e.target.closest('.date-row').remove();
            }
        });
    });
</script>
@endpush
@endsection

