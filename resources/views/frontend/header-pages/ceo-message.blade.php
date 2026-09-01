@extends('frontend.layouts.master')
@section('title', __('ceo_message.title'))
@section('meta_description', __('ceo_message.meta_description'))
@section('content')
    <main class="main about">
        <div class="page-header page-header-bg text-left"
            style="background: 50%/cover #D4E1EA url('assets/images/page-header-bg.jpg');">
            <div class="container">
                  <h1 style="font-size: 3.8rem;"><span>{{ __('ceo_message.leadership') }}</span></h1>
                <a href="{{ route('contact.index') }}" class="btn btn-dark">{{ __('ceo_message.contact_us') }}</a>
            </div>
        </div>

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('ceo_message.ceo_message') }}</li>
                </ol>
            </div>
        </nav>

        <div class="about-section pb-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 text-center mb-4">
                        <img src="{{ asset('assets/images/team/ceo.png') }}" alt="CEO Message" class="img-fluid rounded" style="box-shadow: 0 5px 15px rgba(0,0,0,0.1); max-height: 350px; width: auto; object-fit: cover;">
                    </div>
                    <div class="col-lg-9 col-md-8 pl-lg-5">
                        <h2 class="subtitle">{{ __('ceo_message.message_from_ceo') }}</h2>
                        <p>{{ __('ceo_message.welcome') }}</p>
                        <p>{{ __('ceo_message.philosophy') }}</p>
                        
                        <p class="lead mt-4" style="font-size: 1.6rem;">"{{ __('ceo_message.quote') }}"</p>
                        
                        <p class="mt-4" style="font-size: 1.6rem;"><strong>{{ __('ceo_message.ceo_name') }}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection

