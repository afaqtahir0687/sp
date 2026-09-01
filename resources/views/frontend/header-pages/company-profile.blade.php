@extends('frontend.layouts.master')
@section('title', __('company_profile.title'))
@section('meta_description', __('company_profile.meta_description'))
@section('content')
    <main class="main about">
        <div class="page-header page-header-bg text-left"
            style="background: 50%/cover #D4E1EA url('assets/images/page-header-bg.jpg');">
            <div class="container">
                    <h1 style="font-size: 3.8rem;"><span>{{ __('company_profile.our_history') }}</span></h1>
                <a href="{{ route('contact.index') }}" class="btn btn-dark">{{ __('company_profile.contact_us') }}</a>
            </div>
        </div>

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('company_profile.company_profile') }}</li>
                </ol>
            </div>
        </nav>

        <div class="about-section pb-5">
            <div class="container">
                <h2 class="subtitle">{{ __('company_profile.company_overview') }}</h2>
                <p>{{ __('company_profile.overview_description') }}</p>
                
                <h2 class="subtitle mt-5">{{ __('company_profile.our_achievements') }}</h2>
                <div class="row mt-4">
                    <div class="col-md-6 mb-4">
                        <div class="feature-box bg-white p-4" style="border:1px solid #e1e1e1; border-radius:8px;">
                            <h3 class="mb-2">{{ __('company_profile.industry_leaders') }}</h3>
                            <p>{{ __('company_profile.industry_leaders_desc') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="feature-box bg-white p-4" style="border:1px solid #e1e1e1; border-radius:8px;">
                            <h3 class="mb-2">{{ __('company_profile.expansive_portfolio') }}</h3>
                            <p>{{ __('company_profile.expansive_portfolio_desc') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="feature-box bg-white p-4" style="border:1px solid #e1e1e1; border-radius:8px;">
                            <h3 class="mb-2">{{ __('company_profile.advanced_facilities') }}</h3>
                            <p>{{ __('company_profile.advanced_facilities_desc') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="feature-box bg-white p-4" style="border:1px solid #e1e1e1; border-radius:8px;">
                            <h3 class="mb-2">{{ __('company_profile.dedicated_experts') }}</h3>
                            <p>{{ __('company_profile.dedicated_experts_desc') }}</p>
                        </div>
                    </div>
                </div>

                <div class="mt-4 text-center">
                    <a href="{{ route('category.index') }}" class="btn btn-primary">{{ __('company_profile.discover_our_products') }}</a>
                </div>

            </div>
        </div>
    </main>
@endsection

