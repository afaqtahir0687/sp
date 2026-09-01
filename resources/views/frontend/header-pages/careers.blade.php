@extends('frontend.layouts.master')
@section('title', __('careers.title'))
@section('meta_description', __('careers.meta_description'))
@section('content')
    <main class="main about">
        <div class="page-header page-header-bg text-left"
            style="background: 50%/cover #D4E1EA url('assets/images/page-header-bg.jpg');">
            <div class="container">
                <h1 style="font-size: 3.8rem;"><span>{{ __('careers.join_our_team') }}</span></h1>

                <a href="#open-positions" class="btn btn-dark">{{ __('careers.view_openings') }}</a>
            </div>
        </div>

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('careers.careers') }}</li>
                </ol>
            </div>
        </nav>

        <div class="about-section pb-5">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-4">
                        <h2 class="subtitle">{{ __('careers.why_work_with_us') }}</h2>
                        <p>{{ __('careers.description') }}</p>
                        
                        <ul class="list-unstyled mt-3">
                            <li class="mb-2"><i class="icon-check text-primary mr-2"></i> {{ __('careers.collaborative_culture') }}</li>
                            <li class="mb-2"><i class="icon-check text-primary mr-2"></i> {{ __('careers.professional_growth') }}</li>
                            <li class="mb-2"><i class="icon-check text-primary mr-2"></i> {{ __('careers.competitive_salary') }}</li>
                            <li class="mb-2"><i class="icon-check text-primary mr-2"></i> {{ __('careers.state_of_the_art') }}</li>
                        </ul>
                    </div>
                    <div class="col-lg-6 mb-4">
                        <div class="feature-box bg-gray p-5 rounded h-100 d-flex flex-column justify-content-center text-center">
                            <i class="icon-envelope mb-3" style="font-size:3rem; color:#007bff;"></i>
                            <h3 class="mb-2">{{ __('careers.dont_see_perfect_fit') }}</h3>
                            <p>{{ __('careers.send_resume') }}</p>
                            <a href="mailto:creelogics@gmail.com" class="font-weight-bold">creelogics@gmail.com</a>
                        </div>
                    </div>
                </div>

                <div id="open-positions" class="mt-5 pt-4 border-top">
                    <h2 class="subtitle text-center mb-4">{{ __('careers.current_openings') }}</h2>
                    
                    <div class="row">
                        <div class="col-md-6 mb-4">
                            <div class="feature-box bg-white p-4" style="border:1px solid #e1e1e1; border-radius:8px;">
                                <h3 class="mb-1">{{ __('careers.job_1_title') }}</h3>
                                <p class="text-muted mb-2"><i class="icon-map-marker mr-1"></i> {{ __('careers.job_1_location') }}</p>
                                <p>{{ __('careers.job_1_desc') }}</p>
                                <a href="mailto:creelogics@gmail.com?subject=Application: Senior Graphic Designer" class="btn btn-outline-primary btn-sm mt-2">{{ __('careers.apply_now') }}</a>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="feature-box bg-white p-4" style="border:1px solid #e1e1e1; border-radius:8px;">
                                <h3 class="mb-1">{{ __('careers.job_2_title') }}</h3>
                                <p class="text-muted mb-2"><i class="icon-map-marker mr-1"></i> {{ __('careers.job_2_location') }}</p>
                                <p>{{ __('careers.job_2_desc') }}</p>
                                <a href="mailto:creelogics@gmail.com?subject=Application: Offset Machine Operator" class="btn btn-outline-primary btn-sm mt-2">{{ __('careers.apply_now') }}</a>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-4">
                            <div class="feature-box bg-white p-4" style="border:1px solid #e1e1e1; border-radius:8px;">
                                <h3 class="mb-1">{{ __('careers.job_3_title') }}</h3>
                                <p class="text-muted mb-2"><i class="icon-map-marker mr-1"></i> {{ __('careers.job_3_location') }}</p>
                                <p>{{ __('careers.job_3_desc') }}</p>
                                <a href="mailto:creelogics@gmail.com?subject=Application: Customer Service Representative" class="btn btn-outline-primary btn-sm mt-2">{{ __('careers.apply_now') }}</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </main>
@endsection

