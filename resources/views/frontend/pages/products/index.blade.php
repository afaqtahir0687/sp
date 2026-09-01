@extends('frontend.layouts.master')
@section('title', __('product.products'))
@section('content')
    <main class="main">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-nav">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"><i class="icon-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="#">{{ __('product.most_popular') }}</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ getTrans('category.business_cards', $translations ?? []) }}</a></li>
                    <li class="breadcrumb-item"><a href="#">{{ getTrans('category.business_cards', $translations ?? []) }}</a></li>
                </ol>
            </nav>

            <div class="product-single-container product-single-default">
                <div class="cart-message d-none">
                    <strong class="single-cart-notice">“Men Black Sports Shoes”</strong>
                    <span>{{ __('product.has_been_added_to_cart') }}</span>
                </div>

                <div class="row">
                    <div class="col-lg-5 col-md-6 product-single-gallery">
                        <div class="product-slider-container">
                            <div class="label-group">
                                <div class="product-label label-hot">{{ __('product.hot') }}</div>

                                <div class="product-label label-sale">
                                    -16%
                                </div>
                            </div>

                            <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                <div class="product-item">
                                    <img class="product-single-image" src="assets/images/products/zoom/product-1-big.jpg"
                                        data-zoom-image="assets/images/products/zoom/product-1-big.jpg" width="468"
                                        height="468" alt="product" />
                                </div>
                                <div class="product-item">
                                    <img class="product-single-image" src="assets/images/products/zoom/product-2-big.jpg"
                                        data-zoom-image="assets/images/products/zoom/product-2-big.jpg" width="468"
                                        height="468" alt="product" />
                                </div>
                                <div class="product-item">
                                    <img class="product-single-image" src="assets/images/products/zoom/product-3-big.jpg"
                                        data-zoom-image="assets/images/products/zoom/product-3-big.jpg" width="468"
                                        height="468" alt="product" />
                                </div>
                                <div class="product-item">
                                    <img class="product-single-image" src="assets/images/products/zoom/product-4-big.jpg"
                                        data-zoom-image="assets/images/products/zoom/product-4-big.jpg" width="468"
                                        height="468" alt="product" />
                                </div>
                                <div class="product-item">
                                    <img class="product-single-image" src="assets/images/products/zoom/product-5-big.jpg"
                                        data-zoom-image="assets/images/products/zoom/product-5-big.jpg" width="468"
                                        height="468" alt="product" />
                                </div>
                            </div>
                            <!-- End .product-single-carousel -->
                            <span class="prod-full-screen">
                                <i class="icon-plus"></i>
                            </span>
                        </div>

                        <div class="prod-thumbnail owl-dots">
                            <div class="owl-dot">
                                <img src="assets/images/products/zoom/product-1.jpg" width="110" height="110"
                                    alt="product-thumbnail" />
                            </div>
                            <div class="owl-dot">
                                <img src="assets/images/products/zoom/product-2.jpg" width="110" height="110"
                                    alt="product-thumbnail" />
                            </div>
                            <div class="owl-dot">
                                <img src="assets/images/products/zoom/product-3.jpg" width="110" height="110"
                                    alt="product-thumbnail" />
                            </div>
                            <div class="owl-dot">
                                <img src="assets/images/products/zoom/product-4.jpg" width="110" height="110"
                                    alt="product-thumbnail" />
                            </div>
                            <div class="owl-dot">
                                <img src="assets/images/products/zoom/product-5.jpg" width="110" height="110"
                                    alt="product-thumbnail" />
                            </div>
                        </div>
                    </div><!-- End .product-single-gallery -->

                    <div class="col-lg-7 col-md-6 product-single-details">
                        <h1 class="product-title">Business Cards Standard - Digital</h1>

                        <div class="product-nav">
                            <div class="product-prev">
                                <a href="#">
                                    <span class="product-link"></span>

                                    <span class="product-popup">
                                        <span class="box-content">
                                            <img alt="product" width="150" height="150"
                                                src="assets/images/products/product-3.jpg" style="padding-top: 0px;">

                                            <span>Business card Circled Ultimate 3D Speaker</span>
                                        </span>
                                    </span>
                                </a>
                            </div>

                            <div class="product-next">
                                <a href="#">
                                    <span class="product-link"></span>

                                    <span class="product-popup">
                                        <span class="box-content">
                                            <img alt="product" width="150" height="150"
                                                src="assets/images/products/product-4.jpg" style="padding-top: 0px;">

                                            <span>Business card Blue Backpack for the Young</span>
                                        </span>
                                    </span>
                                </a>
                            </div>
                        </div>

                        <div class="product-customization">
                            <h4 class="customization-title">Customize Your Product</h4>

                            <form id="product-customization-form">
                                <!-- Side 1 Color Label -->
                                <div class="form-group">
                                    <label for="side1Color">Side 1 Color</label>
                                    <select class="form-control" id="side1Color" required>
                                        <!-- <option value="" disabled selected>Select a color</option> -->
                                        <option value="cmyk">CMYK</option>
                                    </select>
                                </div>

                                <!-- Size Dropdown -->
                                <div class="form-group">
                                    <label for="size">Size</label>
                                    <select class="form-control" id="size" required>
                                        <option value="b-cards">B-Cards</option>
                                    </select>
                                </div>

                                <!-- Sides Dropdown -->
                                <div class="form-group">
                                    <label for="sides">Sides</label>
                                    <select class="form-control" id="sides" required>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </div>

                                <!-- Selected Material Dropdown -->
                                <div class="form-group">
                                    <label for="material">Selected Material</label>
                                    <select class="form-control" id="material" required>
                                        <option value="" disabled selected>Select material</option>
                                        <option value="standard">200 coated Matt--</option>
                                        <option value="standard">200 coated Gloss--</option>
                                        <option value="standard">250 coated Matt--</option>
                                        <option value="standard">250 coated Gloss--</option>
                                        <option value="standard">300 coated Matt--</option>
                                        <option value="standard">300 coated Gloss--</option>
                                        <option value="standard">350 coated Matt--</option>
                                        <option value="standard">350 coated Gloss--</option>
                                        <option value="standard">400 invercote (lvory Board)</option>
                                    </select>
                                </div>

                                <!-- Lamination Toggle -->
                                <div class="toggle-box">
                                    <div class="toggle-header">
                                        <span class="toggle-label">
                                            Lamination (Coated Papers Only)
                                        </span>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="laminationToggle"
                                                checked>
                                            <label class="custom-control-label" for="laminationToggle"></label>
                                        </div>
                                    </div>

                                    <!-- SIDES -->
                                    <div id="laminationSides" class="d-none">
                                        <label for="lamination_side">Sides</label>
                                        <select class="form-control" id="lamination_side" name="lamination_side">
                                            <option value="1">1 Side</option>
                                            <option value="2">2 Sides</option>
                                        </select>
                                    </div>

                                    <!-- LAMINATION TYPE -->
                                    <div id="laminationOptions" class="d-none">
                                        <label for="lamination_type">Lamination Type</label>
                                        <select class="form-control" id="lamination_type" name="lamination_type">
                                            <option value="sf-matte">SF Matte Lamination</option>
                                            <option value="sf-gloss">SF Gloss Lamination</option>
                                        </select>
                                    </div>
                                </div>


                                <!-- Round Corner Toggle -->
                                <div class="toggle-box">
                                    <div class="toggle-header">
                                        <span class="toggle-label">
                                            Round Corners
                                            <span id="roundStatus" class="toggle-status">✓</span>
                                        </span>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="roundToggle">
                                            <label class="custom-control-label" for="roundToggle"></label>
                                        </div>
                                    </div>

                                    <div id="roundOptions" class="d-none">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="option-box">
                                                    Upper Left
                                                    <span class="check-icon">✓</span>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="option-box">
                                                    Upper Right
                                                    <span class="check-icon">✓</span>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-2">
                                                <div class="option-box">
                                                    Lower Left
                                                    <span class="check-icon">✓</span>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-2">
                                                <div class="option-box">
                                                    Lower Right
                                                    <span class="check-icon">✓</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Die Cutting Toggle -->
                                <div class="toggle-box">
                                    <div class="toggle-header">
                                        <span class="toggle-label">
                                            Die Cutting
                                            <span id="dieStatus" class="toggle-status">✓</span>
                                        </span>
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="dieToggle">
                                            <label class="custom-control-label" for="dieToggle"></label>
                                        </div>
                                    </div>

                                    <div id="dieOptions" class="d-none">
                                        <select class="form-control">
                                            <option value="">Select Die Cutting</option>
                                            <option>Die Cutting with Ready Die (DGTL)</option>
                                            <option>Custom Die Cut</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Product Memo -->
                                <div class="form-group">
                                    <label for="productMemo">Product Memo</label>
                                    <input type="text" class="form-control" id="productMemo"
                                        placeholder="Enter product memo (optional)">
                                </div>
                                <div class="toggle-box clickable-box" id="shareLinkBox">
                                    <div class="toggle-header">
                                        <strong>Share A Link</strong>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="shareLinkToggle">
                                            <label class="custom-control-label" for="shareLinkToggle"></label>
                                        </div>
                                    </div>

                                    <div id="shareLinkOptions" class="d-none">
                                        <label>Paste your file / design URL</label>
                                        <input type="url" class="form-control"
                                            placeholder="https://example.com/your-design-link">
                                    </div>
                                </div>
                                <div class="toggle-box clickable-box" id="shareSocialBox">
                                    <div class="toggle-header">
                                        <strong>Share Social Links</strong>

                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input" id="shareSocialToggle">
                                            <label class="custom-control-label" for="shareSocialToggle"></label>
                                        </div>
                                    </div>

                                    <div id="shareSocialOptions" class="d-none">
                                        <div class="social-icons d-flex gap-3 mb-4">

                                            <a href="#" class="social-icon social-instagram" title="Instagram">
                                                <i class="fab fa-instagram"></i>
                                            </a>

                                            <a href="#" class="social-icon social-facebook" title="Facebook">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>

                                            <a href="#" class="social-icon social-whatsapp" title="WhatsApp">
                                                <i class="fab fa-whatsapp"></i>
                                            </a>

                                            <a href="#" class="social-icon social-twitter" title="Twitter / X">
                                                <i class="fab fa-twitter"></i>
                                            </a>

                                            <a href="#" class="social-icon social-snapchat" title="Snapchat">
                                                <i class="fab fa-snapchat-ghost"></i>
                                            </a>

                                            <a href="#" class="social-icon social-linkedin" title="LinkedIn">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>

                                            <a href="#" class="social-icon social-telegram" title="Telegram">
                                                <i class="fab fa-telegram-plane"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                <div class="upload-design-row disabled">
                                    <div class="upload-text">
                                        <strong>Upload Design</strong>
                                        <span>Select From Your Saved Designs</span>
                                    </div>

                                    <div class="upload-lock">
                                        <span>Login for this</span>
                                        <i class="fa fa-lock"></i>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div><!-- End .product-single-details -->
                </div><!-- End .row -->
            </div><!-- End .product-single-container -->

            <div class="order-box">
                <div class="order-header">
                    <h5>Your Order Details</h5>
                </div>

                <div class="order-content container-fluid">
                    <div class="row">
                        <!-- LEFT SIDE -->
                        <div class="col-md-8">
                            <div class="left-box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="label-title">Number of Designs:</label>
                                        <input type="number" class="form-control" value="1">
                                    </div>

                                    <div class="col-md-6">
                                        <label class="label-title">Quantity:</label>

                                        <div id="quantityWrapper">
                                            <select class="form-control" id="quantityField">
                                                <option value="100">100</option>
                                                <option value="200">200</option>
                                                <option value="300">300</option>
                                                <option value="500">500</option>
                                                <option value="1000">1000</option>
                                            </select>
                                        </div>

                                        <div class="mt-1 custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customQuantity">
                                            <label class="custom-control-label" for="customQuantity">Custom</label>
                                            <small class="text-danger d-none" id="quantityError">
                                                Valid Range: 100 – 1000
                                            </small>
                                        </div>
                                    </div>
                                </div>

                                <!-- TABLE -->
                                <div class="table-responsive">
                                    <table class="table table-order">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>Urgency</th>
                                                <th>Price</th>
                                                <th>Production day(s)</th>
                                                <th>Delivery day(s)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr data-urgency="regular" data-rate="95">

                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="urgency" value="regular" checked>

                                                        {{-- <label class="custom-control-label" for="regular"></label> --}}
                                                    </div>
                                                </td>
                                                <td>Regular</td>
                                                <td>{{ format_price(95.00) }}</td>
                                                <td>3 working day(s)</td>
                                                <td>01</td>
                                            </tr>
                                            <tr data-urgency="flexible" data-rate="87.96">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="urgency" value="flexible">

                                                        {{-- <label class="custom-control-label" for="flexible"></label> --}}
                                                    </div>
                                                </td>
                                                <td>Flexible</td>
                                                <td>{{ format_price(87.96) }}</td>
                                                <td>5 working day(s)</td>
                                                <td>01</td>
                                            </tr>

                                            <tr data-urgency="urgent" data-rate="100.96">

                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" name="urgency" value="urgent">

                                                        {{-- <label class="custom-control-label" for="flexible"></label> --}}
                                                    </div>
                                                </td>
                                                <td>Urgent</td>
                                                <td>{{ format_price(100.96) }}</td>
                                                <td>1 working day</td>
                                                <td>01</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- RIGHT SIDE -->
                        <div class="col-md-4">
                            <div class="right-box">
                                <p><strong>Before discount:</strong>
                                    <span class="float-right" id="beforeDiscount">82.61</span>
                                </p>

                                <p><strong>Total discount:</strong>
                                    <span class="float-right" id="discount">0.00</span>
                                </p>

                                <p><strong>Total tax (15.00%):</strong>
                                    <span class="float-right" id="tax">12.39</span>
                                </p>

                                <p class="total-price"><strong>Price:</strong>
                                    <span class="float-right" id="finalPrice">95.00</span>
                                </p>


                                <!-- <button class="btn btn-primary btn-block btn-lg">Add to cart</button> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="product-single-tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="product-tab-desc" data-toggle="tab" href="#product-desc-content"
                            role="tab" aria-controls="product-desc-content" aria-selected="true">Description</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-size" data-toggle="tab" href="#product-size-content"
                            role="tab" aria-controls="product-size-content" aria-selected="true">Size Guide</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content"
                            role="tab" aria-controls="product-tags-content" aria-selected="false">Additional
                            Information</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" id="product-tab-reviews" data-toggle="tab" href="#product-reviews-content"
                            role="tab" aria-controls="product-reviews-content" aria-selected="false">Reviews (1)</a>
                    </li>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                        aria-labelledby="product-tab-desc">
                        <div class="product-desc-content">
                            <h5 class="section-title">Benefits of Business Cards</h5>
                            <ul>
                                <li>Superior Quality Business Cards</li>
                                <li>Make A Good First Impression</li>
                                <li>Available In A Range Of Stunning Paper Finishings
                                </li>
                            </ul>

                            <p>
                                Are you an aspiring entrepreneur or launching a new business? Start building your
                                professional network with attention-grabbing name cards that leave a lasting impression.
                                They’re a simple yet powerful way to share your contact details with business partners and
                                potential clients, helping you make meaningful connections effortlessly.
                            </p>
                            <p>
                                Gogoprint offers a variety of business card printing options and combinations so you can
                                customise it the way you want. Choose between different paper thicknesses, and add a nice
                                finishing touch with glossy, matte or soft/velvet lamination. Place your order today to
                                enjoy a free & fast delivery at your doorsteps.
                            </p>
                            <h5 class="fs-1">Why Choose Us for Name Cards & Business Cards?</h5>
                            <p>
                                <span style="font-weight: bold;">Premium Quality Printing:</span> Crisp text, vibrant
                                colors, and high-quality materials ensure a professional finish.<br>

                                <span style="font-weight: bold;">Customizable Designs:</span> Choose from various sizes,
                                paper types, and finishes to match your brand’s identity.<br>

                                <span style="font-weight: bold;">Fast & Reliable Delivery:</span> Get your business cards
                                printed and delivered quickly with our fast turnaround and free shipping.<br>

                                <span style="font-weight: bold;">Make a Lasting Impression:</span> Stand out with sleek,
                                attention-grabbing business cards that leave a memorable impact.<br>

                                <span style="font-weight: bold;">Professional Name Card Design Services:</span> Our graphic
                                designers create clean, brand-aligned designs that represent your business effectively.
                            </p>

                            <h5 class="fs-1">Best Use Cases For Name Cards & Business Cards</h5>
                            <p>
                                <span style="font-weight: bold;">Networking & Client Meetings:</span> Make a strong first
                                impression by sharing your details professionally at events, conferences, and meetings.<br>

                                <span style="font-weight: bold;">Branding & Marketing:</span> Reinforce your brand identity
                                with well-designed business cards that reflect your company’s personality.<br>

                                <span style="font-weight: bold;">Sales & Lead Generation:</span> Keep potential clients
                                engaged by handing out cards that make it easy for them to reach you.<br>

                                <span style="font-weight: bold;">Partnership & Collaboration Opportunities:</span> Open
                                doors to new business ventures by leaving a lasting connection with partners and investors.
                            </p>


                        </div><!-- End .product-desc-content -->
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="product-size-content" role="tabpanel"
                        aria-labelledby="product-tab-size">
                        <div class="product-size-content">
                            <div class="accordion artwork-accordion" id="artworkAccordion">

                                <!-- Item 1 – Open by default -->
                                <div class="card">
                                    <div class="card-header" id="headingOne">
                                        <h2 class="mb-0">
                                            <button class="accordion-btn" type="button" data-toggle="collapse"
                                                data-target="#collapseOne" aria-expanded="true"
                                                aria-controls="collapseOne">
                                                1. Add 3 mm of bleed
                                                <span class="icon">−</span>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                        data-parent="#artworkAccordion">
                                        <div class="card-body">
                                            During the production of paper products, slight cutting imperfections are
                                            expected.
                                            To avoid this, you should add 3 mm of bleed to all edges of your artwork.
                                            Make sure all colors and elements extend to the edge of the bleed area.
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 2 -->
                                <div class="card">
                                    <div class="card-header" id="headingTwo">
                                        <h2 class="mb-0">
                                            <button class="accordion-btn collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseTwo" aria-expanded="false"
                                                aria-controls="collapseTwo">
                                                2. Keep your content within a 3 mm safety margin
                                                <span class="icon">+</span>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                        data-parent="#artworkAccordion">
                                        <div class="card-body">
                                            Dummy text: Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Nulla facilisi. Phasellus elementum sapien nec tortor viverra.
                                        </div>
                                    </div>
                                </div>

                                <!-- Item 3 -->
                                <div class="card">
                                    <div class="card-header" id="headingThree">
                                        <h2 class="mb-0">
                                            <button class="accordion-btn collapsed" type="button" data-toggle="collapse"
                                                data-target="#collapseThree" aria-expanded="false"
                                                aria-controls="collapseThree">
                                                3. Use CMYK colour mode
                                                <span class="icon">+</span>
                                            </button>
                                        </h2>
                                    </div>

                                    <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                        data-parent="#artworkAccordion">
                                        <div class="card-body">
                                            Dummy text: Suspendisse eget justo vitae arcu fermentum bibendum.
                                            Integer euismod mauris non sem facilisis.
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </div><!-- End .product-size-content -->
                    </div><!-- End .tab-pane -->
                    <style>
                        .artwork-accordion .card {
                            border: none;
                            border-bottom: 1px solid #e5e5e5;
                            border-radius: 0;
                        }

                        .artwork-accordion .card-header {
                            background: transparent;
                            border: none;
                            padding: 0;
                        }

                        .accordion-btn {
                            width: 100%;
                            text-align: left;
                            background: none;
                            border: none;
                            padding: 15px;
                            font-size: 14px;
                            color: #000;
                            font-weight: 600;
                            position: relative;
                        }

                        .accordion-btn .icon {
                            position: absolute;
                            right: 10px;
                            font-size: 22px;
                            font-weight: bold;
                        }

                        .collapse.show+.icon {
                            content: "−";
                        }

                        /* Blue highlight for active item */
                        #collapseOne.show,
                        #artworkAccordion .collapse.show {
                            background: #d8ecf7;
                            border-left: 4px solid #3aaede;
                        }

                        #artworkAccordion .card-body {
                            padding: 15px 20px;
                            font-size: 15px;
                            color: #555;
                        }

                        /* Minus icon logic */
                        .accordion-btn[aria-expanded="true"] .icon {
                            content: "−";
                        }

                        .accordion-btn[aria-expanded="false"] .icon {
                            content: "+";
                        }
                    </style>

                    <div class="tab-pane fade" id="product-tags-content" role="tabpanel"
                        aria-labelledby="product-tab-tags">
                        <p>
                            Our free templates provide you with all the information you need to correctly prepare your
                            artwork files for printing. Simply download the template that matches your desired product
                            configuration.
                        </p>
                    </div><!-- End .tab-pane -->

                    <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                        aria-labelledby="product-tab-reviews">
                        <div class="accordion artwork-accordion" id="artworkAccordion">

                            <!-- Item 1 – Open by default -->
                            <div class="card">
                                <div class="card-header" id="headingOne">
                                    <h2 class="mb-0">
                                        <button class="accordion-btn" type="button" data-toggle="collapse"
                                            data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            1. Add 3 mm of bleed
                                            <span class="icon">−</span>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                    data-parent="#artworkAccordion">
                                    <div class="card-body">
                                        During the production of paper products, slight cutting imperfections are expected.
                                        To avoid this, you should add 3 mm of bleed to all edges of your artwork.
                                        Make sure all colors and elements extend to the edge of the bleed area.
                                    </div>
                                </div>
                            </div>

                            <!-- Item 2 -->
                            <div class="card">
                                <div class="card-header" id="headingTwo">
                                    <h2 class="mb-0">
                                        <button class="accordion-btn collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            2. Keep your content within a 3 mm safety margin
                                            <span class="icon">+</span>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                    data-parent="#artworkAccordion">
                                    <div class="card-body">
                                        Dummy text: Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                        Nulla facilisi. Phasellus elementum sapien nec tortor viverra.
                                    </div>
                                </div>
                            </div>

                            <!-- Item 3 -->
                            <div class="card">
                                <div class="card-header" id="headingThree">
                                    <h2 class="mb-0">
                                        <button class="accordion-btn collapsed" type="button" data-toggle="collapse"
                                            data-target="#collapseThree" aria-expanded="false"
                                            aria-controls="collapseThree">
                                            3. Use CMYK colour mode
                                            <span class="icon">+</span>
                                        </button>
                                    </h2>
                                </div>

                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                    data-parent="#artworkAccordion">
                                    <div class="card-body">
                                        Dummy text: Suspendisse eget justo vitae arcu fermentum bibendum.
                                        Integer euismod mauris non sem facilisis.
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div><!-- End .tab-pane -->
                </div><!-- End .tab-content -->
            </div><!-- End .product-single-tabs -->

            <div class="products-section pt-0">
                <h2 class="section-title">Related Products</h2>

                <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                    <div class="product-default">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="assets/images/products/product-1.jpg" width="280" height="280"
                                    alt="product">
                                <img src="assets/images/products/product-1-2.jpg" width="280" height="280"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">HOT</div>
                                <div class="product-label label-sale">-20%</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="category.html" class="product-category">Category</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ route('products.index') }}">Ultimate 3D Bluetooth Speaker</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">$59.00</del>
                                <span class="product-price">$49.00</span>
                            </div><!-- End .price-box -->
                            <!-- <div class="product-action">
                                <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                                <a href="{{ route('products.index') }}" class="btn-icon btn-add-cart"><i
                                        class="fa fa-arrow-right"></i><span>SELECT
                                        OPTIONS</span></a>
                                <a href="{{ route('products.index') }}" class="btn-quickview" title="Quick View"><i
                                        class="fas fa-external-link-alt"></i></a>
                            </div> -->
                        </div><!-- End .product-details -->
                    </div>

                    <div class="product-default">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="assets/images/products/product-3.jpg" width="280" height="280"
                                    alt="product">
                                <img src="assets/images/products/product-3-2.jpg" width="280" height="280"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">HOT</div>
                                <div class="product-label label-sale">-20%</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="category.html" class="product-category">Category</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ route('products.index') }}">Business card Circled Ultimate 3D Speaker</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">$59.00</del>
                                <span class="product-price">$49.00</span>
                            </div><!-- End .price-box -->
                            <!-- <div class="product-action">
                                <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                                <a href="{{ route('products.index') }}" class="btn-icon btn-add-cart"><i
                                        class="fa fa-arrow-right"></i><span>SELECT
                                        OPTIONS</span></a>
                                <a href="{{ route('products.index') }}" class="btn-quickview" title="Quick View"><i
                                        class="fas fa-external-link-alt"></i></a>
                            </div> -->
                        </div><!-- End .product-details -->
                    </div>

                    <div class="product-default">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="assets/images/products/product-7.jpg" width="280" height="280"
                                    alt="product">
                                <img src="assets/images/products/product-7-2.jpg" width="280" height="280"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">HOT</div>
                                <div class="product-label label-sale">-20%</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="category.html" class="product-category">Category</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ route('products.index') }}">Brown-Black Men Casual Glasses</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">$59.00</del>
                                <span class="product-price">$49.00</span>
                            </div><!-- End .price-box -->
                            <!-- <div class="product-action">
                                <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                                <a href="{{ route('products.index') }}" class="btn-icon btn-add-cart"><i
                                        class="fa fa-arrow-right"></i><span>SELECT
                                        OPTIONS</span></a>
                                <a href="{{ route('products.index') }}" class="btn-quickview" title="Quick View"><i
                                        class="fas fa-external-link-alt"></i></a>
                            </div> -->
                        </div><!-- End .product-details -->
                    </div>

                    <div class="product-default">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="assets/images/products/product-6.jpg" width="280" height="280"
                                    alt="product">
                                <img src="assets/images/products/product-6-2.jpg" width="280" height="280"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">HOT</div>
                                <div class="product-label label-sale">-20%</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="category.html" class="product-category">Category</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ route('products.index') }}">Men Black Gentle Belt</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">$59.00</del>
                                <span class="product-price">$49.00</span>
                            </div><!-- End .price-box -->
                            <!-- <div class="product-action">
                                <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                                <a href="{{ route('products.index') }}" class="btn-icon btn-add-cart"><i
                                        class="fa fa-arrow-right"></i><span>SELECT
                                        OPTIONS</span></a>
                                <a href="{{ route('products.index') }}" class="btn-quickview" title="Quick View"><i
                                        class="fas fa-external-link-alt"></i></a>
                            </div> -->
                        </div><!-- End .product-details -->
                    </div>

                    <div class="product-default">
                        <figure>
                            <a href="{{ route('products.index') }}">
                                <img src="assets/images/products/product-4.jpg" width="280" height="280"
                                    alt="product">
                                <img src="assets/images/products/product-4-2.jpg" width="280" height="280"
                                    alt="product">
                            </a>
                            <div class="label-group">
                                <div class="product-label label-hot">HOT</div>
                                <div class="product-label label-sale">-20%</div>
                            </div>
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="category.html" class="product-category">Category</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ route('products.index') }}">Blue Backpack for the Young - S</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div><!-- End .product-ratings -->
                            </div><!-- End .product-container -->
                            <div class="price-box">
                                <del class="old-price">$59.00</del>
                                <span class="product-price">$49.00</span>
                            </div><!-- End .price-box -->
                            <!-- <div class="product-action">
                                <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                        class="icon-heart"></i></a>
                                <a href="{{ route('products.index') }}" class="btn-icon btn-add-cart"><i
                                        class="fa fa-arrow-right"></i><span>SELECT
                                        OPTIONS</span></a>
                                <a href="{{ route('products.index') }}" class="btn-quickview" title="Quick View"><i
                                        class="fas fa-external-link-alt"></i></a>
                            </div> -->
                        </div><!-- End .product-details -->
                    </div>
                </div><!-- End .products-slider -->
            </div><!-- End .products-section -->
        </div>
        <section class="testimonial-section testimonial-bg bg-gray">
            <div class="container">
                <div class="owl-carousel owl-theme owl-dots-simple mb-4 mb-lg-0 appear-animate"
                    data-owl-options="{ 'rtl': {{ app()->getLocale() == 'ar' ? 'true' : 'false' }},
                        'loop': false,
                        'dots': true,
                        'margin': 20,
                        'responsive': null
                    }"
                    data-animation-name="fadeInRightShorter" data-animation-delay="200">
                    <div class="testimonial testimonial-type1 blockquote-both inner-blockquote owner-center">
                        <div class="testimonial-owner">
                            <div>
                                <figure>
                                    <img src="assets/images/elements/testimonial/client1.png" width="62"
                                        height="62" alt="client" style="border-radius: 50%;">
                                </figure>
                                <blockquote class="text-gray">
                                    <p> We are extremely satisfied with the quality and professionalism of the service.
                                        The team delivered exactly what we needed, on time and with great attention to
                                        detail.
                                        Their support and communication throughout the process were excellent.
                                        We highly recommend them for anyone looking for reliable and high-quality solutions.
                                    </p>
                                </blockquote>
                                <span class="testimonial-title">Fazal Miran</span>
                                <span class="mt-1">CEO</span>
                            </div>
                        </div>
                    </div>
                    <div class="testimonial testimonial-type1 blockquote-both inner-blockquote owner-center">
                        <div class="testimonial-owner">
                            <div>
                                <figure>
                                    <img src="assets/images/elements/testimonial/client1.png" width="62"
                                        height="62" alt="client">
                                </figure>
                                <blockquote class="text-gray">
                                    <p> Working with this company has been a great experience from start to finish.
                                        The quality of work exceeded our expectations and the turnaround time was
                                        impressive.
                                        They were responsive, professional, and truly understood our requirements.
                                        We look forward to continuing our partnership in the future.</p>
                                </blockquote>
                                <strong class="testimonial-title">Fazal Miran</strong>
                                <span>CEO</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End .container -->
    </main><!-- End .main -->

    @push('scripts')
        <script>
            function toggleSection(toggleId, optionIds, statusId = null) {
                const toggle = document.getElementById(toggleId);

                // optionIds ko array bana do
                if (!Array.isArray(optionIds)) {
                    optionIds = [optionIds];
                }

                const status = statusId ? document.getElementById(statusId) : null;

                function applyState() {
                    optionIds.forEach(id => {
                        const el = document.getElementById(id);
                        if (!el) return;

                        toggle.checked ?
                            el.classList.remove('d-none') :
                            el.classList.add('d-none');

                        // option-box reset
                        if (!toggle.checked) {
                            el.querySelectorAll('.option-box').forEach(box => {
                                box.classList.remove('active');
                            });
                        }
                    });

                    if (status) {
                        toggle.checked ?
                            status.classList.add('active') :
                            status.classList.remove('active');
                    }
                }

                toggle.addEventListener('change', applyState);

                // 🔥 page load par bhi apply
                applyState();
            }

            /* ======================
               TOGGLE CALLS
            ====================== */

            // Lamination → 2 dropdowns
            toggleSection(
                'laminationToggle',
                ['laminationSides', 'laminationOptions']
            );

            // Round Corners
            toggleSection(
                'roundToggle',
                'roundOptions',
                'roundStatus'
            );

            // Die Cutting
            toggleSection(
                'dieToggle',
                'dieOptions',
                'dieStatus'
            );

            // Option-box click (round corners)
            document.querySelectorAll('.option-box').forEach(box => {
                box.addEventListener('click', function() {
                    this.classList.toggle('active');
                });
            });
        </script>

        <script>
            const shareBox = document.getElementById('shareLinkBox');
            const shareToggle = document.getElementById('shareLinkToggle');
            const shareOptions = document.getElementById('shareLinkOptions');

            /* Toggle change */
            shareToggle.addEventListener('change', function() {
                shareOptions.classList.toggle('d-none', !this.checked);
            });

            /* Full box click (except input) */
            shareBox.addEventListener('click', function(e) {
                if (
                    e.target.tagName !== 'INPUT' &&
                    e.target.tagName !== 'LABEL'
                ) {
                    shareToggle.checked = !shareToggle.checked;
                    shareToggle.dispatchEvent(new Event('change'));
                }
            });
        </script>
        <script>
            const shareSocialBox = document.getElementById('shareSocialBox');
            const shareSocialToggle = document.getElementById('shareSocialToggle');
            const shareSocialOptions = document.getElementById('shareSocialOptions');

            /* Toggle change */
            shareSocialToggle.addEventListener('change', function() {
                shareSocialOptions.classList.toggle('d-none', !this.checked);
            });

            /* Full box clickable (except icons) */
            shareSocialBox.addEventListener('click', function(e) {
                if (
                    e.target.tagName !== 'A' &&
                    e.target.tagName !== 'I' &&
                    e.target.tagName !== 'INPUT' &&
                    e.target.tagName !== 'LABEL'
                ) {
                    shareSocialToggle.checked = !shareSocialToggle.checked;
                    shareSocialToggle.dispatchEvent(new Event('change'));
                }
            });
        </script>


        <script>
            const checkbox = document.getElementById('customQuantity');
            const wrapper = document.getElementById('quantityWrapper');
            const error = document.getElementById('quantityError');

            checkbox.addEventListener('change', function() {

                // CUSTOM ON
                if (this.checked) {
                    wrapper.innerHTML = `
                <input type="number"
                       id="quantityField"
                       class="form-control"
                       placeholder="Enter quantity (100 - 1000)"
                       min="100"
                       max="1000">
            `;

                    document.getElementById('quantityField')
                        .addEventListener('input', function() {
                            const val = parseInt(this.value);
                            if (val < 100 || val > 1000 || isNaN(val)) {
                                error.classList.remove('d-none');
                            } else {
                                error.classList.add('d-none');
                            }
                        });

                }
                // CUSTOM OFF → ORIGINAL DROPDOWN BACK
                else {
                    wrapper.innerHTML = `
                <select class="form-control" id="quantityField">
                    <option value="100">100</option>
                    <option value="200">200</option>
                    <option value="300">300</option>
                    <option value="500">500</option>
                    <option value="1000">1000</option>
                </select>
            `;
                    error.classList.add('d-none');
                }
            });
        </script>

        <script>
            const TAX_RATE = 0.15;

            function getQuantity() {
                const field = document.getElementById('quantityField');
                return parseInt(field.value) || 0;
            }

            function getUrgencyRate() {
                const selected = document.querySelector('input[name="urgency"]:checked').value;
                const row = document.querySelector(`tr[data-urgency="${selected}"]`);
                return parseFloat(row.dataset.rate);
            }

            function calculatePrice() {
                const qty = getQuantity();
                if (qty < 100) return;

                const ratePer100 = getUrgencyRate();
                const basePrice = (qty / 100) * ratePer100;

                const discount = 0; // future ready
                const taxableAmount = basePrice - discount;
                const tax = taxableAmount * TAX_RATE;
                const finalPrice = taxableAmount + tax;

                document.getElementById('beforeDiscount').innerText = basePrice.toFixed(2);
                document.getElementById('discount').innerText = discount.toFixed(2);
                document.getElementById('tax').innerText = tax.toFixed(2);
                document.getElementById('finalPrice').innerText = finalPrice.toFixed(2);
            }

            // Quantity change
            document.addEventListener('input', function(e) {
                if (e.target.id === 'quantityField') {
                    calculatePrice();
                }
            });

            // Urgency change
            document.querySelectorAll('input[name="urgency"]').forEach(radio => {
                radio.addEventListener('change', calculatePrice);
            });

            // Initial calculation
            calculatePrice();
        </script>
    @endpush
@endsection

