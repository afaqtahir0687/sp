@extends('frontend.layouts.master')
@section('title', __('about.title'))
@section('meta_description', __('about.meta_description'))
@section('meta_keywords', __('about.meta_keywords'))
@section('content')
    <main class="main about">
        <div class="page-header page-header-bg text-left"
            style="background: 50%/cover #D4E1EA url('assets/images/page-header-bg.jpg');">
            <div class="container">
                  <h1 style="font-size: 3.8rem;"><span>{{ __('about.page_title') }}</span></h1>
                <a href="{{ route('contact.index') }}" class="btn btn-dark">{{ __('about.contact') }}</a>
            </div><!-- End .container -->
        </div><!-- End .page-header -->

        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('about.about_us') }}</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="about-section">
            <div class="container">
                <h2 class="subtitle">{{ __('about.about_crelogics') }}</h2>
                <p>{{ __('about.about_text_1') }}</p>
                <p>{{ __('about.about_text_2') }}</p>

                <p class="lead">“{{ __('about.mission_quote') }}”</p>

            </div><!-- End .container -->
        </div><!-- End .about-section -->

        <div class="features-section bg-gray pt-5 mt-5">
            <div class="container">
                <h2 class="subtitle">{{ __('about.why_choose_us') }}</h2>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="feature-box bg-white">
                            <i class="icon-shipped"></i>

                            <div class="feature-box-content p-0">
                                <h3>{{ __('about.free_shipping') }}</h3>
                                <p>{{ __('about.dummy_text') }}</p>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-lg-4 -->

                    <div class="col-lg-4">
                        <div class="feature-box bg-white">
                            <i class="icon-us-dollar"></i>

                            <div class="feature-box-content p-0">
                                <h3>{{ __('about.money_back_guarantee') }}</h3>
                                <p>{{ __('about.dummy_text') }}</p>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-lg-4 -->

                    <div class="col-lg-4">
                        <div class="feature-box bg-white">
                            <i class="icon-online-support"></i>

                            <div class="feature-box-content p-0">
                                <h3>{{ __('about.online_support') }}</h3>
                                <p>{{ __('about.dummy_text') }}</p>
                            </div><!-- End .feature-box-content -->
                        </div><!-- End .feature-box -->
                    </div><!-- End .col-lg-4 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .features-section -->

        <div class="testimonials-section pt-5 mt-3">
            <div class="container">
                <h2 class="subtitle text-center">{{ __('about.happy_clients') }}</h2>

                <div class="testimonials-carousel owl-carousel owl-theme images-left"
                    data-owl-options="{ 'rtl': {{ app()->getLocale() == 'ar' ? 'true' : 'false' }},
                'margin': 20,
                'lazyLoad': true,
                'autoHeight': true,
                'dots': false,
                'responsive': {
                    '0': {
                        'items': 1
                    },
                    '992': {
                        'items': 2
                    }
                }
            }">
                    <div class="testimonial">
                        <div class="testimonial-owner">
                            <figure>
                                <img src="assets/images/clients/client1.png" alt="client">
                            </figure>

                            <div>
                                <strong class="testimonial-title">{{ __('about.client_name_1') }}</strong>
                                <span>{{ __('about.client_role_1') }}</span>
                            </div>
                        </div><!-- End .testimonial-owner -->

                        <blockquote>
                            <p>{{ __('about.client_quote_1') }}</p>
                        </blockquote>
                    </div><!-- End .testimonial -->

                    <div class="testimonial">
                        <div class="testimonial-owner">
                            <figure>
                                <img src="assets/images/clients/client2.png" alt="client">
                            </figure>

                            <div>
                                <strong class="testimonial-title">{{ __('about.client_name_2') }}</strong>
                                <span>{{ __('about.client_role_2') }}</span>
                            </div>
                        </div><!-- End .testimonial-owner -->

                        <blockquote>
                            <p>{{ __('about.client_quote_1') }}</p>
                        </blockquote>
                    </div><!-- End .testimonial -->

                    <div class="testimonial">
                        <div class="testimonial-owner">
                            <figure>
                                <img src="assets/images/clients/client1.png" alt="client">
                            </figure>

                            <div>
                                <strong class="testimonial-title">{{ __('about.client_name_1') }}</strong>
                                <span>{{ __('about.client_role_1') }}</span>
                            </div>
                        </div><!-- End .testimonial-owner -->

                        <blockquote>
                            <p>{{ __('about.client_quote_1') }}</p>
                        </blockquote>
                    </div><!-- End .testimonial -->
                </div><!-- End .testimonials-slider -->
            </div><!-- End .container -->
        </div><!-- End .testimonials-section -->

        <div class="counters-section bg-gray pt-5 mt-3">
            <div class="container">
                <div class="row  text-center justify-content-between">
                    <div class="col count-container">
                        <div class="count-wrapper">
                            <span class="count-to" data-from="0" data-to="200" data-speed="2000"
                                data-refresh-interval="50">200+</span>
                        </div><!-- End .count-wrapper -->
                        <h4 class="count-title">{{ __('about.million_customers') }}</h4>
                    </div><!-- End .col-md-4 -->

                    <div class="col count-container">
                        <div class="count-wrapper">
                            <span class="count-to" data-from="0" data-to="1800" data-speed="2000"
                                data-refresh-interval="50">1800+</span>
                        </div><!-- End .count-wrapper -->
                        <h4 class="count-title">{{ __('about.team_members') }}</h4>
                    </div><!-- End .col-md-4 -->

                    <div class="col count-container">
                        <div class="count-wrapper line-height-1">
                            <span class="count-to" data-from="0" data-to="24" data-speed="2000"
                                data-refresh-interval="50">24 HR</span>
                        </div><!-- End .count-wrapper -->
                        <h4 class="count-title">{{ __('about.support_available') }}</h4>
                    </div><!-- End .col-md-4 -->

                    <div class="col count-container">
                        <div class="count-wrapper">
                            <span class="count-to" data-from="0" data-to="265" data-speed="2000"
                                data-refresh-interval="50">265+</span>
                        </div><!-- End .count-wrapper -->
                        <h4 class="count-title">{{ __('about.support_available') }}</h4>
                    </div><!-- End .col-md-4 -->

                    <div class="col count-container">
                        <div class="count-wrapper line-height-1">
                            <span class="count-to" data-from="0" data-to="99" data-speed="2000"
                                data-refresh-interval="50">99%</span>
                        </div><!-- End .count-wrapper -->
                        <h4 class="count-title">{{ __('about.support_available') }}</h4>
                    </div><!-- End .col-md-4 -->
                </div><!-- End .row -->
            </div><!-- End .container -->
        </div><!-- End .counters-section -->
    </main><!-- End .main -->
@endsection

