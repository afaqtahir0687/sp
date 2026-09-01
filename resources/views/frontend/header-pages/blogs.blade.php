@extends('frontend.layouts.master')
@section('title', __('blog.title'))
@section('meta_description', __('blog.meta_description'))
@section('meta_keywords', __('blog.meta_keywords'))
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('blog.blog') }}</li>
                </ol>
            </div><!-- End .container -->
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="blog-section row">
                        <div class="col-md-6 col-lg-4">
                            <article class="post">
                                <div class="post-media">
                                    <a href="{{ route('single.index') }}">
                                        <img src="{{ asset('assets/images/products/product-1.jpg') }}" width="280"
                                            height="280" alt="product">
                                    </a>
                                    <div class="post-date">
                                        <span class="day">26</span>
                                        <span class="month">Feb</span>
                                    </div>
                                </div><!-- End .post-media -->

                                <div class="post-body">
                                    <h2 class="post-title">
                                        <a href="{{ route('single.index') }}">Business Card Front & Back</a>
                                    </h2>
                                    <div class="post-content">
                                        <p>
                                            High-quality front & back business card printing with sharp colors and
                                            professional finishing for a strong brand impression.
                                        </p>

                                    </div><!-- End .post-content -->
                                    <a href="{{ route('single.index') }}" class="post-comment">0 {{ __('blog.comments') }}</a>
                                </div><!-- End .post-body -->
                            </article><!-- End .post -->
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <article class="post">
                                <div class="post-media">
                                    <a href="{{ route('single.index') }}">
                                        <img src="{{ asset('assets/images/products/product-2.jpg') }}" width="280"
                                            height="280" alt="product">
                                    </a>
                                    <div class="post-date">
                                        <span class="day">26</span>
                                        <span class="month">Feb</span>
                                    </div>
                                </div><!-- End .post-media -->

                                <div class="post-body">
                                    <h2 class="post-title">
                                        <a href="{{ route('single.index') }}">Professional Roll up Banner Design</a>
                                    </h2>
                                    <div class="post-content">
                                        <p>
                                            Professional roll up banner design with high-quality visuals, perfect for
                                            exhibitions, events, and promotional displays.
                                        </p>

                                    </div><!-- End .post-content -->
                                    <a href="{{ route('single.index') }}" class="post-comment">0 {{ __('blog.comments') }}</a>
                                </div><!-- End .post-body -->
                            </article><!-- End .post -->
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <article class="post">
                                <div class="post-media">
                                    <a href="{{ route('single.index') }}">
                                        <img src="{{ asset('assets/images/products/product-3.jpg') }}" width="280"
                                            height="280" alt="product">
                                    </a>
                                    <div class="post-date">
                                        <span class="day">26</span>
                                        <span class="month">Feb</span>
                                    </div>
                                </div><!-- End .post-media -->

                                <div class="post-body">
                                    <h2 class="post-title">
                                        <a href="{{ route('single.index') }}">Postcard Printing</a>
                                    </h2>
                                    <div class="post-content">
                                        <p>
                                            Premium postcard printing with vivid colors and professional finishing,
                                            ideal for promotions and marketing campaigns.
                                        </p>

                                    </div><!-- End .post-content -->
                                    <a href="{{ route('single.index') }}" class="post-comment">0 {{ __('blog.comments') }}</a>
                                </div><!-- End .post-body -->
                            </article><!-- End .post -->
                        </div>
                        <div class="col-md-6 col-lg-4">
                            <article class="post">
                                <div class="post-media">
                                    <a href="{{ route('single.index') }}">
                                        <img src="{{ asset('assets/images/products/product-4.jpg') }}" width="280"
                                            height="280" alt="product">
                                    </a>
                                    <div class="post-date">
                                        <span class="day">26</span>
                                        <span class="month">Feb</span>
                                    </div>
                                </div><!-- End .post-media -->

                                <div class="post-body">
                                    <h2 class="post-title">
                                        <a href="{{ route('single.index') }}">Folder Flyer Printing</a>
                                    </h2>
                                    <div class="post-content">
                                        <p>
                                            Professional folder flyer printing with premium quality and clean finishing,
                                            perfect for marketing and corporate use.
                                        </p>

                                    </div><!-- End .post-content -->
                                    <a href="{{ route('single.index') }}" class="post-comment">0 {{ __('blog.comments') }}</a>
                                </div><!-- End .post-body -->
                            </article><!-- End .post -->
                        </div>
                    </div>
                </div><!-- End .col-lg-9 -->

                <div class="sidebar-toggle custom-sidebar-toggle">
                    <i class="fas fa-sliders-h"></i>
                </div>
                <div class="sidebar-overlay"></div>
                <aside class="sidebar mobile-sidebar col-lg-3">
                    <div class="sidebar-wrapper" data-sticky-sidebar-options='{"offsetTop": 72}'>
                        <div class="widget widget-categories">
                            <h4 class="widget-title">Blog Categories</h4>

                            <ul class="list">
                                <li>
                                    <a href="#">Business Cards</a>
                                </li>
                                <li>
                                    <a href="#">Flyers & Folders</a>
                                    <ul class="list">
                                        <li><a href="#">Folder Flyers</a></li>
                                        <li><a href="#">Leaflets</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Banners & Posters</a>
                                    <ul class="list">
                                        <li><a href="#">Roll-up Banners</a></li>
                                        <li><a href="#">Posters</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a href="#">Postcards</a>
                                </li>
                                <li>
                                    <a href="#">Corporate Stationery</a>
                                </li>
                            </ul>
                        </div><!-- End .widget -->


                        <div class="widget widget-post">
                            <h4 class="widget-title">Recent Posts</h4>

                            <ul class="simple-post-list">
                                <li>
                                    <div class="post-media">
                                        <a href="{{ route('single.index') }}">
                                            <img src="{{ asset('assets/images/products/product-1.jpg') }}" width="75"
                                                height="75" alt="product">
                                        </a>
                                    </div><!-- End .post-media -->
                                    <div class="post-info">
                                        <a href="{{ route('single.index') }}">Business Card Front & Back</a>
                                        <div class="post-meta">February 26, 2018</div>
                                        <!-- End .post-meta -->
                                    </div><!-- End .post-info -->
                                </li>

                                <li>
                                    <div class="post-media">
                                        <a href="{{ route('single.index') }}">
                                            <img src="{{ asset('assets/images/products/product-3.jpg') }}" width="75"
                                                height="75" alt="product">
                                        </a>
                                    </div><!-- End .post-media -->
                                    <div class="post-info">
                                        <a href="{{ route('single.index') }}">Postcard Printing</a>
                                        <div class="post-meta">February 26, 2018</div><!-- End .post-meta -->
                                    </div><!-- End .post-info -->
                                </li>
                            </ul>
                        </div><!-- End .widget -->

                        <div class="widget">
                            <h4 class="widget-title">Tags</h4>

                            <div class="tagcloud">
                                <a href="#">ARTICLES</a>
                                <a href="#">CHAT</a>
                            </div><!-- End .tagcloud -->
                        </div><!-- End .widget -->
                    </div><!-- End .sidebar-wrapper -->
                </aside><!-- End .col-lg-3 -->
            </div><!-- End .row -->
        </div><!-- End .container -->
    </main><!-- End .main -->
@endsection

