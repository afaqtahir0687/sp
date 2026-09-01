@extends('frontend.layouts.master')
@section('title', __('contact.title'))
@section('meta_description', __('contact.meta_description'))
@section('meta_keywords', __('contact.meta_keywords'))
@section('content')
	<main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}"><i class="icon-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('contact.contact_us') }}
                    </li>
                </ol>
            </div>
        </nav>

        <div id="map"></div>

        <div class="container contact-us-container">
            <div class="contact-info">
                <div class="row">
                    <div class="col-12">
                        <h2 class="ls-n-25 m-b-1">
                            {{ __('contact.contact_info') }}
                        </h2>

                        <p>
                            {{ $setting->description ?? 'Get in touch with us for all your printing and advertisement needs. Our dedicated team is here to help you achieve your business goals with high-quality services.' }}
                        </p>
                    </div>

                    <div class="col-sm-6 col-lg-3">
                        <div class="feature-box text-center">
                            <i class="fa fa-map-marker-alt"></i>
                            <div class="feature-box-content">
                                <h3>{{ __('contact.address') }}</h3>
                                <h5>{{ $setting->address ?? '123 Wall Street, New York / NY' }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="feature-box text-center">
                            <i class="fa fa-mobile-alt"></i>
                            <div class="feature-box-content">
                                <h3>{{ __('contact.phone_number') }}</h3>
                                <h5>{{ $setting->phone ?? '(800) 123-4567' }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="feature-box text-center">
                            <i class="far fa-envelope"></i>
                            <div class="feature-box-content">
                                <h3>{{ __('contact.email_address') }}</h3>
                                <h5>{{ $setting->email ?? 'support@crelogics.com' }}</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="feature-box text-center">
                            <i class="far fa-calendar-alt"></i>
                            <div class="feature-box-content">
                                <h3>{{ __('contact.working_days_hours') }}</h3>
                                <h5>{{ $setting->working_hours ?? 'Mon - Sun / 9:00AM - 8:00PM' }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <h2 class="mt-6 mb-2">{{ __('contact.send_message') }}</h2>



                    <form class="mb-0" action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label class="mb-1" for="contact-name">{{ __('contact.your_name') }}
                                <span class="required">*</span></label>
                            <input type="text" class="form-control" id="contact-name" name="contact-name" value="{{ old('contact-name') }}" required />
                        </div>

                        <div class="form-group">
                            <label class="mb-1" for="contact-email">{{ __('contact.your_email') }}
                                <span class="required">*</span></label>
                            <input type="email" class="form-control" id="contact-email" name="contact-email" value="{{ old('contact-email') }}" required />
                        </div>

                        <div class="form-group">
                            <label class="mb-1" for="contact-message">{{ __('contact.your_message') }}
                                <span class="required">*</span></label>
                            <textarea cols="30" rows="5" id="contact-message" class="form-control" name="contact-message" required>{{ old('contact-message') }}</textarea>
                        </div>

                        <div class="form-footer mb-0">
                            <button type="submit" class="btn btn-dark font-weight-normal">
                                {{ __('contact.send_message_button') }}
                            </button>
                        </div>
                    </form>
                </div>

                <div class="col-lg-6">
                    <h2 class="mt-6 mb-1">{{ __('contact.faq_title') }}</h2>
                    <div id="accordion">
                        @forelse($faqs as $index => $faq)
                            <div class="card card-accordion">
                                <a class="card-header {{ $index === 0 ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#collapse{{ $faq->id }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}" aria-controls="collapse{{ $faq->id }}">
                                    {{ $faq->question }}
                                </a>

                                <div id="collapse{{ $faq->id }}" class="collapse {{ $index === 0 ? 'show' : '' }}" data-parent="#accordion">
                                    <p>{{ $faq->answer }}</p>
                                </div>
                            </div>
                        @empty
                            <p>{{ __('contact.no_faqs') }}</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-8"></div>
    </main>
@endsection
