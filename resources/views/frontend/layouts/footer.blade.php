<footer class="footer bg-dark" style="background-color: #262263 !important;">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">{{ __('footer.contact_info') }}</h4>
                        <ul class="contact-info">
                            <li>
                                <span class="contact-info-label">{{ __('footer.address') }}</span>{{ __('footer.address_value') }}
                            </li>
                            <li>
                                <span class="contact-info-label">{{ __('footer.phone') }}</span><a
                                    href="tel:+966557834154">+966557834154</a>
                            </li>
                            <li>
                                <span class="contact-info-label">{{ __('footer.email') }}</span> <a
                                    href="mailto:creelogics@gmail.com">creelogics@gmail.com</a>
                            </li>
                            <li>
                                <span class="contact-info-label">{{ __('footer.working_days') }}</span> {{ __('footer.working_hours') }}
                            </li>
                        </ul>
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->

                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">{{ __('footer.customer_service') }}</h4>

                        <ul class="links">
                            <li><a href="{{ route('track.order') }}">{{ __('footer.order_tracking') }}</a></li>
                            <li><a href="{{ route('dashboard') }}">{{ __('footer.orders_history') }}</a></li>
                            <li><a href="{{ route('dashboard') }}">{{ __('footer.my_account') }}</a></li>
                            <li><a href="{{ route('about.index') }}">{{ __('footer.about_us') }}</a></li>
                            <li><a href="{{ route('vision.mission') }}">{{ __('footer.vision_mission') }}</a></li>
                            <li><a href="{{ route('ceo.message') }}">{{ __('footer.ceo_message') }}</a></li>
                            <li><a href="{{ route('company.profile') }}">{{ __('footer.company_profile') }}</a></li>
                            <li><a href="{{ route('services.page') }}">{{ __('footer.our_services') }}</a></li>
                            <li><a href="{{ route('clients.page') }}">{{ __('footer.our_clients') }}</a></li>
                            <li><a href="{{ route('careers.page') }}">{{ __('footer.careers') }}</a></li>
                            <li><a href="{{ route('contact.index') }}">{{ __('footer.contact_us') }}</a></li>
                            <li><a href="{{ route('request.visit') }}">{{ __('footer.request_sales_visit') }}</a></li>
                        </ul>
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->

                <div class="col-lg-3 col-sm-6">
                    <div class="widget">
                        <h4 class="widget-title">{{ __('footer.popular_tags') }}</h4>

                        <div class="tagcloud">
                            <a href="#">{{ __('footer.business_cards') }}</a>
                            <a href="#">{{ __('footer.acrylic') }}</a>
                            <a href="#">{{ __('footer.signage') }}</a>
                            <a href="#">{{ __('footer.3d_letter') }}</a>
                            <a href="#">{{ __('footer.sticker') }}</a>
                            <a href="#">{{ __('footer.banner') }}</a>
                            <a href="#">{{ __('footer.gift_items') }}</a>
                            <a href="#">{{ __('footer.pop_up') }}</a>
                            <a href="#">{{ __('footer.roll_up') }}</a>
                            <a href="#">{{ __('footer.flyer') }}</a>
                            <a href="#">{{ __('footer.backlit') }}</a>
                        </div>
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->

                <div class="col-lg-3 col-sm-6">
                    <div class="widget widget-newsletter">
                        <h4 class="widget-title">{{ __('footer.subscribe_newsletter') }}</h4>
                        <p>{{ __('footer.newsletter_text') }}
                        </p>
                        <form action="#" class="mb-0">
                            <input type="email" class="form-control m-b-3" placeholder="{{ __('footer.email_address') }}" required>

                            <input type="submit" class="btn btn-primary shadow-none" value="{{ __('footer.subscribe') }}">
                        </form>
                    </div>
                    <!-- End .widget -->
                </div>
                <!-- End .col-lg-3 -->
            </div>
            <!-- End .row -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .footer-middle -->

    <div class="container">
        <div class="footer-bottom">
            <div class="container d-sm-flex align-items-center">
                <div class="footer-left">
                    <span class="footer-copyright">{{ __('footer.all_rights_reserved') }}</span>
                </div>

                <div class="footer-right ml-auto mt-1 mt-sm-0">
                    <div class="payment-icons">
                        <span class="payment-icon visa"
                            style="background-image: url(assets/images/payments/payment-visa.svg)"></span>
                        <span class="payment-icon paypal"
                            style="background-image: url(assets/images/payments/payment-paypal.svg)"></span>
                        <span class="payment-icon stripe"
                            style="background-image: url(assets/images/payments/payment-stripe.png)"></span>
                        <span class="payment-icon verisign"
                            style="background-image:  url(assets/images/payments/payment-verisign.svg)"></span>
                    </div>
                </div>
            </div>
        </div>
        <!-- End .footer-bottom -->
    </div>
    <!-- End .container -->
</footer>
