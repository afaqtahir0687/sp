@extends('frontend.layouts.master')
@section('title', __('services.title'))
@section('meta_description', __('services.meta_description'))
@section('content')
    <main class="main about">
        <div class="page-header page-header-bg text-left"
            style="background: 50%/cover #D4E1EA url('assets/images/page-header-bg.jpg');">
            <div class="container">
                  <h1 style="font-size: 3.8rem;"><span>{{ __('services.what_we_do') }}</span></h1>
                <a href="{{ route('contact.index') }}" class="btn btn-dark">{{ __('services.contact_us') }}</a>
            </div>
        </div>

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('services.our_services') }}</li>
                </ol>
            </div>
        </nav>

        <div class="features-section pt-3 pb-5">
            <div class="container">
                <h2 class="subtitle text-center mb-5">{{ __('services.premium_printing_services') }}</h2>
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="feature-box bg-gray">
                            <i class="icon-business-book"></i>
                            <div class="feature-box-content p-0">
                                <h3>{{ __('services.commercial_printing') }}</h3>
                                <p>{{ __('services.commercial_printing_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="feature-box bg-gray">
                            <i class="icon-mode-grid"></i>
                            <div class="feature-box-content p-0">
                                <h3>{{ __('services.large_format_printing') }}</h3>
                                <p>{{ __('services.large_format_printing_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="feature-box bg-gray">
                            <i class="icon-heart"></i>
                            <div class="feature-box-content p-0">
                                <h3>{{ __('services.promotional_gifts') }}</h3>
                                <p>{{ __('services.promotional_gifts_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="feature-box bg-gray">
                            <i class="icon-shopping-cart"></i>
                            <div class="feature-box-content p-0">
                                <h3>{{ __('services.packaging_solutions') }}</h3>
                                <p>{{ __('services.packaging_solutions_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="feature-box bg-gray">
                            <i class="icon-star"></i>
                            <div class="feature-box-content p-0">
                                <h3>{{ __('services.graphic_design') }}</h3>
                                <p>{{ __('services.graphic_design_desc') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 mb-4">
                        <div class="feature-box bg-gray">
                            <i class="icon-shipped"></i>
                            <div class="feature-box-content p-0">
                                <h3>{{ __('services.web_to_print') }}</h3>
                                <p>{{ __('services.web_to_print_desc') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="mt-4 text-center">
                    <a href="{{ route('category.index') }}" class="btn btn-primary">{{ __('services.start_your_order') }}</a>
                </div>
            </div>
        </div>
    </main>
@endsection

