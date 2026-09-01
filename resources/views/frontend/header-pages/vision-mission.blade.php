@extends('frontend.layouts.master')
@section('title', __('vision_mission.title'))
@section('meta_description', __('vision_mission.meta_description'))
@section('meta_keywords', __('vision_mission.meta_keywords'))
@section('content')
    <main class="main about">
        <div class="page-header page-header-bg text-left"
            style="background: 50%/cover #D4E1EA url('assets/images/page-header-bg.jpg');">
            <div class="container">
                <h1 style="font-size: 3.8rem;"><span>{{ __('vision_mission.who_we_are') }}</span></h1>
                <a href="{{ route('contact.index') }}" class="btn btn-dark">{{ __('vision_mission.contact_us') }}</a>
            </div><!-- End .container -->
        </div><!-- End .page-header -->

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('vision_mission.vision_mission') }}</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="about-section">
            <div class="container">
                <h2 class="subtitle">{{ __('vision_mission.our_vision') }}</h2>
                <p>{{ __('vision_mission.vision_text') }}</p>
                <p>{{ __('vision_mission.vision_text2') }}</p>

                <h2 class="subtitle mt-5">{{ __('vision_mission.our_mission') }}</h2>
                <p>{{ __('vision_mission.mission_text') }}</p>
                
                <p class="lead">“{{ __('vision_mission.lead_quote') }}”</p>

            </div><!-- End .container -->
        </div><!-- End .about-section -->

        <div class="features-section bg-gray pt-5 mt-5 pb-5">
            <div class="container">
                <h2 class="subtitle">{{ __('vision_mission.our_core_values') }}</h2>
                <div class="row">
                    <div class="col-lg-4 mb-4">
                        <div class="feature-box bg-white">
                            <i class="icon-star"></i>

                            <div class="feature-box-content p-0">
                                <h3>{{ __('vision_mission.quality_excellence') }}</h3>
                                <p>{{ __('vision_mission.quality_excellence_desc') }}</p>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-lg-4 -->

                    <div class="col-lg-4 mb-4">
                        <div class="feature-box bg-white">
                            <i class="icon-user"></i>

                            <div class="feature-box-content p-0">
                                <h3>{{ __('vision_mission.customer_first') }}</h3>
                                <p>{{ __('vision_mission.customer_first_desc') }}</p>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-lg-4 -->

                    <div class="col-lg-4 mb-4">
                        <div class="feature-box bg-white">
                            <i class="icon-business-book"></i>

                            <div class="feature-box-content p-0">
                                <h3>{{ __('vision_mission.innovation_integrity') }}</h3>
                                <p>{{ __('vision_mission.innovation_integrity_desc') }}</p>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-lg-4 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .features-section -->
        
        <div class="about-section mt-5 pb-5">
            <div class="container text-center">
                <h2 class="subtitle">{{ __('vision_mission.ready_to_bring') }}</h2>
                <p>{{ __('vision_mission.join_thousands') }}</p>
                <div class="mt-3">
                    <a href="{{ route('category.index') }}" class="btn btn-primary mr-3">{{ __('vision_mission.explore_our_products') }}</a>
                </div>
            </div>
        </div>

    </main>
@endsection

