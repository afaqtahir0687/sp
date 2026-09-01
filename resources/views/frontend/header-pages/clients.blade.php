@extends('frontend.layouts.master')
@section('title', __('clients.title'))
@section('meta_description', __('clients.meta_description'))
@section('content')
    <main class="main about">
        <div class="page-header page-header-bg text-left"
            style="background: 50%/cover #D4E1EA url('assets/images/page-header-bg.jpg');">
            <div class="container">
                <h1 style="font-size: 3.8rem;"><span>{{ __('clients.trusted_by_our_clients') }}</span></h1>

                <a href="{{ route('contact.index') }}" class="btn btn-dark">{{ __('clients.join_them_today') }}</a>
            </div>
        </div>

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('clients.our_clients') }}</li>
                </ol>
            </div>
        </nav>

        <div class="about-section pb-5">
            <div class="container text-center">
                <h2 class="subtitle">{{ __('clients.partners_in_success') }}</h2>
                <p class="mb-5">
                    {{ __('clients.description') }}
                </p>

                {{-- Client Logos Grid (Static) --}}
                <div class="row align-items-center justify-content-center">

                    <div class="col-6 col-sm-4 col-md-3 mb-4">
                        <div class="feature-box bg-white p-4"
                            style="border:1px solid #eee; border-radius:10px; display:flex; align-items:center; justify-content:center; height:120px;">
                            <img src="{{ asset('assets/images/elements/testimonial/client1.png') }}" alt="Client 1"
                                class="img-fluid" style="max-height:80px;"
                                onerror="this.src='{{ asset('assets/images/team/ceo.png') }}'">
                        </div>
                    </div>

                    <div class="col-6 col-sm-4 col-md-3 mb-4">
                        <div class="feature-box bg-white p-4"
                            style="border:1px solid #eee; border-radius:10px; display:flex; align-items:center; justify-content:center; height:120px;">
                            <img src="{{ asset('assets/images/elements/testimonial/client1.png') }}" alt="Client 2"
                                class="img-fluid" style="max-height:80px;"
                                onerror="this.src='{{ asset('assets/images/team/ceo.png') }}'">
                        </div>
                    </div>

                    <div class="col-6 col-sm-4 col-md-3 mb-4">
                        <div class="feature-box bg-white p-4"
                            style="border:1px solid #eee; border-radius:10px; display:flex; align-items:center; justify-content:center; height:120px;">
                            <img src="{{ asset('assets/images/elements/testimonial/client1.png') }}" alt="Client 3"
                                class="img-fluid" style="max-height:80px;"
                                onerror="this.src='{{ asset('assets/images/team/ceo.png') }}'">
                        </div>
                    </div>

                    <div class="col-6 col-sm-4 col-md-3 mb-4">
                        <div class="feature-box bg-white p-4"
                            style="border:1px solid #eee; border-radius:10px; display:flex; align-items:center; justify-content:center; height:120px;">
                            <img src="{{ asset('assets/images/elements/testimonial/client1.png') }}" alt="Client 4"
                                class="img-fluid" style="max-height:80px;"
                                onerror="this.src='{{ asset('assets/images/team/ceo.png') }}'">
                        </div>
                    </div>

                </div>
                {{-- End Client Logos Grid --}}

                <div class="testimonials-section pt-5 mt-5 pb-5">
                    <h2 class="subtitle text-center">{{ __('clients.what_they_say') }}</h2>
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="testimonial">
                                <div class="testimonial-owner">
                                    <figure>
                                        <img src="{{ asset('assets/images/clients/client1.png') }}" alt="Client" onerror="this.src='{{ asset('assets/images/placeholder.jpg') }}'" style="width: 60px; height: 60px; border-radius: 50%; object-fit: cover;">
                                    </figure>
                                    <div>
                                        <strong class="testimonial-title">{{ __('clients.client_name') }}</strong>
                                        <span>{{ __('clients.client_role') }}</span>
                                    </div>
                                </div>
                                <blockquote>
                                    <p>{{ __('clients.client_quote') }}</p>
                                </blockquote>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection
