@extends('admin.layouts.master')

@section('content')
<div class="container-fluid mb-5">

    <!-- Top Action Bar (Hidden in Print) -->
    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4 pb-2 border-bottom no-print">
        <div class="mb-2 mb-md-0">
            <h1 class="h3 mb-1 text-gray-800 font-weight-bold">
                <i class="fas fa-file-invoice text-primary mr-2"></i>Product Details & Specification Sheet
            </h1>
            <p class="text-muted small mb-0">
                View complete bilingual product specifications, options, materials, and download official PDF document.
            </p>
        </div>
        <div class="d-flex flex-wrap align-items-center gap-2">
            <button type="button" class="btn btn-danger btn-sm shadow-sm mr-2 mb-1" id="downloadPdfBtn" style="background-color: #e74a3b !important; border-color: #e74a3b !important;">
                <i class="fas fa-file-pdf mr-1"></i> Download PDF
            </button>
            <button type="button" class="btn btn-primary btn-sm shadow-sm mr-2 mb-1" onclick="window.print()">
                <i class="fas fa-print mr-1"></i> Print / Save PDF
            </button>
            <a href="{{ route('admin.products.pdf', $product->id) }}" target="_blank" class="btn btn-secondary btn-sm shadow-sm mr-2 mb-1" style="background-color: #4e73df !important; border-color: #4e73df !important;">
                <i class="fas fa-external-link-alt mr-1"></i> Clean PDF View
            </a>
            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm shadow-sm mr-2 mb-1">
                <i class="fas fa-edit mr-1"></i> Edit Product
            </a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-dark btn-sm shadow-sm mb-1" style="background-color: #5a5c69 !important; border-color: #5a5c69 !important;">
                <i class="fas fa-arrow-left mr-1"></i> Back to List
            </a>
        </div>
    </div>

    <!-- Alert / Notice for Admin -->
    <div class="alert alert-info alert-dismissible fade show shadow-sm no-print mb-4" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-info-circle fa-2x mr-3 text-info"></i>
            <div>
                <strong>Bilingual Specification Document:</strong>
                All details below are formatted in both <strong>English</strong> and <strong>Arabic (باللغة العربية)</strong>. Click <strong>"Download PDF"</strong> to instantly generate a portable PDF file or <strong>"Print / Save PDF"</strong> to use your browser's native PDF printer.
            </div>
        </div>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <!-- Printable & Exportable PDF Document Container -->
    <div id="productPdfSheet" class="card shadow mb-4 pdf-export-card">
        <div class="card-body p-4 p-md-5">

            <!-- 1. Document Header -->
            <div class="spec-header pb-4 mb-4 border-bottom">
                <div class="row align-items-center">
                    <div class="col-sm-6 text-left">
                        <div class="d-flex align-items-center mb-2">
                            <div class="spec-brand-icon mr-3">
                                <i class="fas fa-cube fa-2x text-primary"></i>
                            </div>
                            <div>
                                <h3 class="mb-0 font-weight-bold text-dark" style="letter-spacing: 1px;">CRELOGICS</h3>
                                <div class="text-uppercase small font-weight-bold text-primary">Printing & Packaging Solutions</div>
                            </div>
                        </div>
                        <div class="small text-muted">
                            <div><strong>Official Technical Specification Sheet</strong></div>
                            <div>Document Ref: <code>CR-PRD-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</code> | SKU: <strong>{{ $product->sku ?? 'N/A' }}</strong></div>
                        </div>
                    </div>
                    <div class="col-sm-6 text-right mt-3 mt-sm-0" dir="rtl">
                        <div class="d-flex align-items-center justify-content-end mb-2">
                            <div>
                                <h3 class="mb-0 font-weight-bold text-dark" style="font-family: 'Cairo', sans-serif;">كريلوجيكس</h3>
                                <div class="small font-weight-bold text-primary" style="font-family: 'Cairo', sans-serif;">حلول الطباعة والتغليف المتكاملة</div>
                            </div>
                            <div class="spec-brand-icon ml-3">
                                <i class="fas fa-print fa-2x text-primary"></i>
                            </div>
                        </div>
                        <div class="small text-muted" style="font-family: 'Cairo', sans-serif;">
                            <div><strong>وثيقة المواصفات الفنية المعتمدة للمنتج</strong></div>
                            <div>تاريخ الإصدار: <strong>{{ now()->format('Y-m-d') }}</strong> ({{ now()->format('h:i A') }})</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Product Title & Category Banner -->
            <div class="spec-title-banner p-3 p-md-4 rounded mb-4" style="background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); color: #ffffff;">
                <div class="row align-items-center">
                    <div class="col-md-7 border-right-md">
                        <div class="text-uppercase small text-info font-weight-bold mb-1">
                            {{ $product->category ? $product->category->name_en : 'General' }}
                            @if($product->subcategory)
                                <i class="fas fa-chevron-right mx-1 fa-xs text-white-50"></i> {{ $product->subcategory->name_en }}
                            @endif
                        </div>
                        <h2 class="h3 font-weight-bold mb-2 text-white">{{ $product->name_en }}</h2>
                        <div class="d-flex flex-wrap align-items-center gap-2">
                            <span class="badge badge-{{ $product->status == 'active' ? 'success' : 'secondary' }} px-2 py-1 mr-2">
                                <i class="fas fa-circle fa-xs mr-1"></i> {{ ucfirst($product->status) }}
                            </span>
                            @if($product->is_featured)
                                <span class="badge badge-warning px-2 py-1 mr-2 text-dark"><i class="fas fa-star mr-1"></i> Featured</span>
                            @endif
                            @if($product->is_new_arrival)
                                <span class="badge badge-info px-2 py-1 mr-2"><i class="fas fa-sparkles mr-1"></i> New Arrival</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-5 text-right mt-3 mt-md-0" dir="rtl">
                        <div class="small text-info font-weight-bold mb-1" style="font-family: 'Cairo', sans-serif;">
                            {{ $product->category ? $product->category->name_ar : 'عام' }}
                            @if($product->subcategory)
                                <i class="fas fa-chevron-left mx-1 fa-xs text-white-50"></i> {{ $product->subcategory->name_ar }}
                            @endif
                        </div>
                        <h2 class="h3 font-weight-bold mb-2 text-white" style="font-family: 'Cairo', sans-serif;">{{ $product->name_ar }}</h2>
                        <span class="badge badge-light px-2 py-1 text-dark" style="font-family: 'Cairo', sans-serif;">
                            {{ $product->status == 'active' ? 'متاح ونشط للطلب' : 'غير متوفر حالياً' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- 3. Key Financials & Turnaround Summary -->
            <div class="row mb-4">
                <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                    <div class="card h-100 border-left-primary shadow-sm bg-light">
                        <div class="card-body p-3">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Base Price / السعر الأساسي</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">SAR {{ number_format((float)$product->price, 2) }}</div>
                            <small class="text-muted">Per unit rate</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                    <div class="card h-100 border-left-success shadow-sm bg-light">
                        <div class="card-body p-3">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Discount Price / الخصم</div>
                            <div class="h4 mb-0 font-weight-bold text-gray-800">
                                @if($product->discount_price > 0)
                                    SAR {{ number_format((float)$product->discount_price, 2) }}
                                @else
                                    <span class="text-muted font-weight-normal small">No Active Discount</span>
                                @endif
                            </div>
                            <small class="text-muted">
                                @if($product->discount_end_date)
                                    Ends: {{ \Carbon\Carbon::parse($product->discount_end_date)->format('d M Y') }}
                                @else
                                    Standard Rate
                                @endif
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                    <div class="card h-100 border-left-info shadow-sm bg-light">
                        <div class="card-body p-3">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Production / مدة الإنتاج</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $product->production_days ?? 3 }} Business Days</div>
                            <small class="text-muted">Flexible: {{ $product->flexible_production_days ?? 5 }}d | Urgent: {{ $product->urgent_production_days ?? 1 }}d</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 mb-3 mb-md-0">
                    <div class="card h-100 border-left-warning shadow-sm bg-light">
                        <div class="card-body p-3">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Delivery / التوصيل والشحن</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $product->delivery_days ?? 1 }} Business Day(s)</div>
                            <small class="text-muted">Kingdom-wide shipping</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Media & Overview Section -->
            <div class="row mb-4 align-items-center">
                <div class="col-md-4 text-center mb-3 mb-md-0">
                    <div class="spec-image-box border p-2 rounded bg-white shadow-sm">
                        @php
                            $imgSrc = $mainImageDataUri ?? ($product->image ? asset('storage/' . $product->image) : asset('assets/images/placeholder.png'));
                        @endphp
                        <img src="{{ $imgSrc }}" alt="{{ $product->name_en }}" class="img-fluid rounded" style="max-height: 230px; object-fit: contain;">
                    </div>
                    @if(!empty($galleryDataUris) || (!empty($product->images) && is_array($product->images)))
                        <div class="d-flex flex-wrap justify-content-center mt-2 gap-1">
                            @if(!empty($galleryDataUris))
                                @foreach($galleryDataUris as $gUri)
                                    <img src="{{ $gUri }}" class="img-thumbnail mr-1 mb-1" style="width: 50px; height: 50px; object-fit: cover;">
                                @endforeach
                            @elseif(!empty($product->images))
                                @foreach($product->images as $gImg)
                                    <img src="{{ asset('storage/' . $gImg) }}" class="img-thumbnail mr-1 mb-1" style="width: 50px; height: 50px; object-fit: cover;">
                                @endforeach
                            @endif
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <!-- Turnaround & Urgency Matrix Table -->
                    <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-2">
                        <i class="fas fa-clock text-primary mr-1"></i> Production & Turnaround Schedules / جداول الإنتاج ومواعيد التسليم
                    </h6>
                    <div class="table-responsive mb-3">
                        <table class="table table-bordered table-sm mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Option / الخيار</th>
                                    <th>Production Turnaround</th>
                                    <th>Unit Rate (SAR)</th>
                                    <th>المدة وسعر الوحدة</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong><i class="fas fa-check-circle text-primary mr-1"></i> Regular (عادي)</strong></td>
                                    <td>{{ $product->production_days ?? 3 }} Working Days</td>
                                    <td>SAR {{ number_format((float)$product->price, 2) }}</td>
                                    <td dir="rtl" style="font-family: 'Cairo', sans-serif;">{{ $product->production_days ?? 3 }} أيام عمل (أساسي)</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-calendar-alt text-info mr-1"></i> Flexible (مرن)</strong></td>
                                    <td>{{ $product->flexible_production_days ?? 5 }} Working Days</td>
                                    <td>SAR {{ number_format((float)($product->flexible_rate > 0 ? $product->flexible_rate : $product->price), 2) }}</td>
                                    <td dir="rtl" style="font-family: 'Cairo', sans-serif;">{{ $product->flexible_production_days ?? 5 }} أيام عمل (سعر اقتصادي)</td>
                                </tr>
                                <tr>
                                    <td><strong><i class="fas fa-bolt text-warning mr-1"></i> Urgent (مستعجل)</strong></td>
                                    <td>{{ $product->urgent_production_days ?? 1 }} Working Day(s)</td>
                                    <td>SAR {{ number_format((float)($product->urgent_rate > 0 ? $product->urgent_rate : $product->price), 2) }}</td>
                                    <td dir="rtl" style="font-family: 'Cairo', sans-serif;">{{ $product->urgent_production_days ?? 1 }} يوم عمل سريع</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- 5. Full Bilingual Specifications Table -->
            <div class="spec-section mb-4">
                <h5 class="font-weight-bold text-dark border-bottom pb-2 mb-3">
                    <i class="fas fa-sliders-h text-primary mr-2"></i>Product Customization Specifications / المواصفات الفنية والخيارات
                </h5>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped spec-table mb-0">
                        <thead class="thead-dark">
                            <tr>
                                <th style="width: 25%;">Feature / الميزة</th>
                                <th style="width: 37%;">English Specification</th>
                                <th style="width: 38%;" class="text-right" dir="rtl">المواصفات بالعربية</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Quantities -->
                            <tr>
                                <td class="font-weight-bold bg-light">
                                    <i class="fas fa-layer-group text-primary mr-1"></i> Quantities<br>
                                    <small class="text-muted">الكميات المتاحة</small>
                                </td>
                                <td>
                                    @if(!empty($product->quantities) && is_array($product->quantities))
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($product->quantities as $qty)
                                                <span class="badge badge-secondary mr-1 mb-1 px-2 py-1">{{ $qty }}</span>
                                            @endforeach
                                        </div>
                                    @else
                                        <span class="text-muted">Not specified</span>
                                    @endif
                                    @if($product->allow_custom_quantity)
                                        <div class="mt-1 small text-success font-weight-bold"><i class="fas fa-check-circle"></i> Custom Quantity Allowed</div>
                                    @endif
                                </td>
                                <td class="text-right" dir="rtl" style="font-family: 'Cairo', sans-serif;">
                                    @if(!empty($product->quantities) && is_array($product->quantities))
                                        {{ implode(' ، ', $product->quantities) }}
                                    @else
                                        غير محدد
                                    @endif
                                    @if($product->allow_custom_quantity)
                                        <div class="mt-1 small text-success font-weight-bold">مسموح بإدخال كمية مخصصة</div>
                                    @endif
                                </td>
                            </tr>

                            <!-- Sizes -->
                            <tr>
                                <td class="font-weight-bold bg-light">
                                    <i class="fas fa-ruler-combined text-primary mr-1"></i> Sizes<br>
                                    <small class="text-muted">المقاسات والأبعاد</small>
                                </td>
                                <td>
                                    {{ !empty($product->sizes) && is_array($product->sizes) ? implode(', ', $product->sizes) : 'Standard Size' }}
                                </td>
                                <td class="text-right" dir="rtl" style="font-family: 'Cairo', sans-serif;">
                                    {{ !empty($product->sizes_ar) && is_array($product->sizes_ar) ? implode(' ، ', $product->sizes_ar) : 'مقاس قياسي' }}
                                </td>
                            </tr>

                            <!-- Colors -->
                            <tr>
                                <td class="font-weight-bold bg-light">
                                    <i class="fas fa-palette text-primary mr-1"></i> Colors / Printing Mode<br>
                                    <small class="text-muted">الألوان ونمط الطباعة</small>
                                </td>
                                <td>
                                    {{ !empty($product->side_1_colors) && is_array($product->side_1_colors) ? implode(', ', $product->side_1_colors) : 'Full Color (CMYK)' }}
                                </td>
                                <td class="text-right" dir="rtl" style="font-family: 'Cairo', sans-serif;">
                                    {{ !empty($product->side_1_colors_ar) && is_array($product->side_1_colors_ar) ? implode(' ، ', $product->side_1_colors_ar) : 'طباعة ملونة كاملة (CMYK)' }}
                                </td>
                            </tr>

                            <!-- Sides -->
                            <tr>
                                <td class="font-weight-bold bg-light">
                                    <i class="fas fa-clone text-primary mr-1"></i> Sides Options<br>
                                    <small class="text-muted">خيارات الأوجه</small>
                                </td>
                                <td>
                                    @if(!empty($product->sides_options) && is_array($product->sides_options))
                                        @foreach($product->sides_options as $side)
                                            <span class="badge badge-info mr-1">{{ $side }} {{ is_numeric($side) ? ($side == 1 ? 'Side' : 'Sides') : '' }}</span>
                                        @endforeach
                                    @else
                                        1 Side, 2 Sides
                                    @endif
                                </td>
                                <td class="text-right" dir="rtl" style="font-family: 'Cairo', sans-serif;">
                                    @if(!empty($product->sides_options_ar) && is_array($product->sides_options_ar))
                                        {{ implode(' ، ', $product->sides_options_ar) }}
                                    @else
                                        وجه واحد ، وجهين
                                    @endif
                                </td>
                            </tr>

                            <!-- Lamination -->
                            <tr>
                                <td class="font-weight-bold bg-light">
                                    <i class="fas fa-shield-alt text-primary mr-1"></i> Lamination & Coating<br>
                                    <small class="text-muted">التغليف والسلوفان</small>
                                </td>
                                <td>
                                    @if(!empty($product->lamination_types) && is_array($product->lamination_types))
                                        <div><strong>Types:</strong> {{ implode(', ', $product->lamination_types) }}</div>
                                    @else
                                        <span class="text-muted">No lamination options configured</span>
                                    @endif
                                    <div class="small text-muted mt-1">
                                        Base Lamination Rate: <strong>SAR {{ number_format((float)($product->lamination_price ?? 0), 2) }}</strong> (2 Sides) / <strong>SAR {{ number_format((float)(($product->lamination_price ?? 0) / 2), 2) }}</strong> (1 Side)
                                    </div>
                                </td>
                                <td class="text-right" dir="rtl" style="font-family: 'Cairo', sans-serif;">
                                    @if(!empty($product->lamination_types_ar) && is_array($product->lamination_types_ar))
                                        <div><strong>الأنواع:</strong> {{ implode(' ، ', $product->lamination_types_ar) }}</div>
                                    @else
                                        بدون خيارات تغليف إضافية
                                    @endif
                                    <div class="small text-muted mt-1">
                                        سعر التغليف الإضافي: <strong>{{ number_format((float)($product->lamination_price ?? 0), 2) }} ريال</strong> (وجهين) / <strong>{{ number_format((float)(($product->lamination_price ?? 0) / 2), 2) }} ريال</strong> (وجه واحد)
                                    </div>
                                </td>
                            </tr>

                            <!-- Die Cutting & Corners -->
                            <tr>
                                <td class="font-weight-bold bg-light">
                                    <i class="fas fa-cut text-primary mr-1"></i> Die Cutting & Corners<br>
                                    <small class="text-muted">القص والزوايا المستديرة</small>
                                </td>
                                <td>
                                    <div>{{ !empty($product->die_cutting_options) && is_array($product->die_cutting_options) ? implode(', ', $product->die_cutting_options) : 'Standard Cut' }}</div>
                                    @if($product->allow_round_corners)
                                        <div class="small text-success font-weight-bold mt-1"><i class="fas fa-check"></i> Round Corners Available</div>
                                    @endif
                                </td>
                                <td class="text-right" dir="rtl" style="font-family: 'Cairo', sans-serif;">
                                    <div>{{ !empty($product->die_cutting_options_ar) && is_array($product->die_cutting_options_ar) ? implode(' ، ', $product->die_cutting_options_ar) : 'قص مستقيم قياسي' }}</div>
                                    @if($product->allow_round_corners)
                                        <div class="small text-success font-weight-bold mt-1">إمكانية زوايا مستديرة (Round Corners)</div>
                                    @endif
                                </td>
                            </tr>

                            @if(!empty($product->orientations) || !empty($product->orientations_ar))
                            <!-- Orientation -->
                            <tr>
                                <td class="font-weight-bold bg-light">
                                    <i class="fas fa-sync text-primary mr-1"></i> Orientation<br>
                                    <small class="text-muted">الاتجاه</small>
                                </td>
                                <td>{{ is_array($product->orientations) ? implode(', ', $product->orientations) : $product->orientations }}</td>
                                <td class="text-right" dir="rtl" style="font-family: 'Cairo', sans-serif;">{{ is_array($product->orientations_ar) ? implode(' ، ', $product->orientations_ar) : $product->orientations_ar }}</td>
                            </tr>
                            @endif

                            @if(!empty($product->folding_options) || !empty($product->folding_options_ar))
                            <!-- Folding -->
                            <tr>
                                <td class="font-weight-bold bg-light">
                                    <i class="fas fa-book-open text-primary mr-1"></i> Folding Options<br>
                                    <small class="text-muted">خيارات الطي</small>
                                </td>
                                <td>{{ is_array($product->folding_options) ? implode(', ', $product->folding_options) : $product->folding_options }}</td>
                                <td class="text-right" dir="rtl" style="font-family: 'Cairo', sans-serif;">{{ is_array($product->folding_options_ar) ? implode(' ، ', $product->folding_options_ar) : $product->folding_options_ar }}</td>
                            </tr>
                            @endif

                            @if(!empty($product->binding_options) || !empty($product->binding_options_ar))
                            <!-- Binding -->
                            <tr>
                                <td class="font-weight-bold bg-light">
                                    <i class="fas fa-book text-primary mr-1"></i> Binding Options<br>
                                    <small class="text-muted">خيارات التجليد</small>
                                </td>
                                <td>{{ is_array($product->binding_options) ? implode(', ', $product->binding_options) : $product->binding_options }}</td>
                                <td class="text-right" dir="rtl" style="font-family: 'Cairo', sans-serif;">{{ is_array($product->binding_options_ar) ? implode(' ، ', $product->binding_options_ar) : $product->binding_options_ar }}</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- 6. Materials & Custom Pricing Matrix -->
            <div class="spec-section mb-4">
                <h5 class="font-weight-bold text-dark border-bottom pb-2 mb-3">
                    <i class="fas fa-boxes text-primary mr-2"></i>Materials & Custom Unit Pricing / المواد والأوراق والأسعار المخصصة
                </h5>
                @php
                    $materials = $product->materials ?? [];
                    $materialsAr = $product->materials_ar ?? [];
                    $materialPrices = $product->material_prices ?? [];
                @endphp
                @if(!empty($materials) && is_array($materials))
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm table-hover mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th style="width: 5%;">#</th>
                                    <th style="width: 40%;">Material Name (English)</th>
                                    <th style="width: 35%;" class="text-right" dir="rtl">نوع الخامة / الورق (بالعربية)</th>
                                    <th style="width: 20%;" class="text-right">Unit Rate (SAR)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($materials as $idx => $mat)
                                    @php
                                        $matAr = $materialsAr[$idx] ?? '—';
                                        $trimmed = trim($mat);
                                        $hasCustomPrice = isset($materialPrices[$trimmed]) && is_numeric($materialPrices[$trimmed]);
                                        $matRate = $product->getMaterialRate($mat);
                                    @endphp
                                    <tr>
                                        <td>{{ $idx + 1 }}</td>
                                        <td>
                                            <strong>{{ $mat }}</strong>
                                            @if($hasCustomPrice)
                                                <span class="badge badge-success ml-1">Custom Rate</span>
                                            @endif
                                        </td>
                                        <td class="text-right" dir="rtl" style="font-family: 'Cairo', sans-serif;">
                                            <strong>{{ $matAr }}</strong>
                                        </td>
                                        <td class="text-right font-weight-bold {{ $hasCustomPrice ? 'text-success' : 'text-dark' }}">
                                            SAR {{ number_format((float)$matRate, 2) }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="alert alert-secondary mb-0">No specific materials configured for this product. Default base price applies.</div>
                @endif
            </div>

            <!-- 7. Bilingual Descriptions & Documentation -->
            <div class="spec-section mb-4">
                <h5 class="font-weight-bold text-dark border-bottom pb-2 mb-3">
                    <i class="fas fa-align-left text-primary mr-2"></i>Product Descriptions & Documentation / الوصف ودليل المواصفات
                </h5>

                <!-- Short Description -->
                <div class="card mb-3 border-left-secondary">
                    <div class="card-header bg-light py-2">
                        <strong>Short Description / نبذة مختصرة</strong>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-6 border-right">
                                <small class="text-muted font-weight-bold text-uppercase d-block mb-1">English</small>
                                <p class="mb-0 text-dark">{{ $product->short_description_en ?: 'No English short description provided.' }}</p>
                            </div>
                            <div class="col-md-6 text-right mt-3 mt-md-0" dir="rtl">
                                <small class="text-muted font-weight-bold d-block mb-1" style="font-family: 'Cairo', sans-serif;">باللغة العربية</small>
                                <p class="mb-0 text-dark" style="font-family: 'Cairo', sans-serif;">{{ $product->short_description_ar ?: 'لا يوجد وصف مختصر بالعربية.' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Full Description -->
                <div class="card mb-3 border-left-secondary">
                    <div class="card-header bg-light py-2">
                        <strong>Detailed Product Description / الوصف التفصيلي الكامل</strong>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-6 border-right">
                                <small class="text-muted font-weight-bold text-uppercase d-block mb-1">English</small>
                                <div class="text-dark spec-rich-text">{!! $product->description_en ?: '<p class="text-muted">No detailed English description available.</p>' !!}</div>
                            </div>
                            <div class="col-md-6 text-right mt-3 mt-md-0" dir="rtl">
                                <small class="text-muted font-weight-bold d-block mb-1" style="font-family: 'Cairo', sans-serif;">باللغة العربية</small>
                                <div class="text-dark spec-rich-text" style="font-family: 'Cairo', sans-serif;">{!! $product->description_ar ?: '<p class="text-muted">لا يوجد وصف تفصيلي بالعربية.</p>' !!}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Size Guide & Technical Info -->
                <div class="row">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <div class="card h-100 border-left-info">
                            <div class="card-header bg-light py-2 d-flex justify-content-between">
                                <strong>Size Guide / دليل المقاسات</strong>
                                <span class="small text-muted">Dimensions</span>
                            </div>
                            <div class="card-body p-3">
                                <div class="mb-2">
                                    <div class="spec-rich-text">{!! $product->size_guide_en ?: '<span class="text-muted">Standard dimensions apply.</span>' !!}</div>
                                </div>
                                <hr>
                                <div class="text-right" dir="rtl" style="font-family: 'Cairo', sans-serif;">
                                    <div class="spec-rich-text">{!! $product->size_guide_ar ?: '<span class="text-muted">المقاسات القياسية المعتمدة.</span>' !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card h-100 border-left-info">
                            <div class="card-header bg-light py-2 d-flex justify-content-between">
                                <strong>Additional Information / معلومات إضافية</strong>
                                <span class="small text-muted">Artwork & Specs</span>
                            </div>
                            <div class="card-body p-3">
                                <div class="mb-2">
                                    <div class="spec-rich-text">{!! $product->additional_info_en ?: '<span class="text-muted">Standard print guidelines apply.</span>' !!}</div>
                                </div>
                                <hr>
                                <div class="text-right" dir="rtl" style="font-family: 'Cairo', sans-serif;">
                                    <div class="spec-rich-text">{!! $product->additional_info_ar ?: '<span class="text-muted">تعليمات التصميم والطباعة القياسية.</span>' !!}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 8. Document Footer & Official Notice -->
            <div class="spec-footer pt-4 mt-5 border-top text-muted small">
                <div class="row align-items-center">
                    <div class="col-md-6 text-left">
                        <div><strong>Crelogics Printing & Packaging Solutions</strong></div>
                        <div>Website: <a href="http://sp.crelogics.com" target="_blank">http://sp.crelogics.com</a> | Riyadh, Kingdom of Saudi Arabia</div>
                        <div class="text-muted mt-1">&copy; {{ date('Y') }} Crelogics. All rights reserved. Document generated for administrative & technical reference.</div>
                    </div>
                    <div class="col-md-6 text-right mt-3 mt-md-0" dir="rtl" style="font-family: 'Cairo', sans-serif;">
                        <div><strong>كريلوجيكس لحلول الطباعة والتغليف</strong></div>
                        <div>المملكة العربية السعودية | الرياض</div>
                        <div class="text-muted mt-1">تم إصدار هذه الوثيقة إلكترونياً من نظام إدارة المنتجات وتعتبر معتمدة للمواصفات الفنية.</div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</div>
@endsection

@push('styles')
<!-- Google Fonts for Cairo (Arabic) & Inter -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>
    /* Styling for High Quality Print & PDF Export */
    .pdf-export-card {
        background-color: #ffffff !important;
        border: 1px solid #e3e6f0;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
        color: #2e384d;
    }

    .spec-brand-icon {
        width: 48px;
        height: 48px;
        background: #eaf6fc;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .spec-table th, .spec-table td {
        vertical-align: middle !important;
        padding: 0.75rem 0.85rem;
    }

    .spec-rich-text p {
        margin-bottom: 0.5rem;
    }
    .spec-rich-text ul {
        padding-left: 1.25rem;
        margin-bottom: 0.5rem;
    }
    [dir="rtl"] .spec-rich-text ul {
        padding-right: 1.25rem;
        padding-left: 0;
    }

    /* Print Styles */
    @media print {
        body {
            background-color: #ffffff !important;
            margin: 0 !important;
            padding: 0 !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Hide all admin chrome */
        #accordionSidebar,
        .navbar,
        footer.sticky-footer,
        .no-print,
        .custom-toast-container,
        #downloadPdfBtn,
        .scroll-to-top {
            display: none !important;
        }

        #content-wrapper {
            margin: 0 !important;
            padding: 0 !important;
            background: #ffffff !important;
        }

        .container-fluid {
            padding: 0 !important;
            margin: 0 !important;
            max-width: 100% !important;
        }

        .pdf-export-card {
            border: none !important;
            box-shadow: none !important;
            padding: 0 !important;
        }

        .card-body {
            padding: 10mm !important;
        }

        @page {
            size: A4 portrait;
            margin: 8mm 8mm 8mm 8mm;
        }

        .spec-title-banner {
            background: #1e293b !important;
            color: #ffffff !important;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        .badge-success { background-color: #1cc88a !important; color: #fff !important; }
        .badge-warning { background-color: #f6c23e !important; color: #000 !important; }
        .badge-info { background-color: #36b9cc !important; color: #fff !important; }
        .thead-dark th { background-color: #2e384d !important; color: #fff !important; }
    }
</style>
@endpush

@push('scripts')
<!-- html2pdf.js for 1-click client-side PDF download -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
$(document).ready(function() {
    $('#downloadPdfBtn').on('click', function(e) {
        e.preventDefault();
        var $btn = $(this);
        var originalText = $btn.html();
        
        $btn.html('<i class="fas fa-spinner fa-spin mr-1"></i> Generating PDF...').prop('disabled', true);

        var element = document.getElementById('productPdfSheet');
        var productName = "{{ Str::slug($product->name_en) }}";
        var filename = 'Crelogics-Product-' + {{ $product->id }} + '-' + (productName || 'SpecSheet') + '.pdf';

        var opt = {
            margin:       [8, 8, 8, 8],
            filename:     filename,
            image:        { type: 'jpeg', quality: 0.98 },
            html2canvas:  { scale: 2, useCORS: true, letterRendering: true },
            jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
            pagebreak:    { mode: ['avoid-all', 'css', 'legacy'] }
        };

        if (typeof html2pdf !== 'undefined') {
            html2pdf().set(opt).from(element).save().then(function() {
                $btn.html(originalText).prop('disabled', false);
            }).catch(function(err) {
                console.error("html2pdf error:", err);
                $btn.html(originalText).prop('disabled', false);
                // Fallback to window.print()
                window.print();
            });
        } else {
            // If library didn't load from CDN, fallback gracefully to browser print
            $btn.html(originalText).prop('disabled', false);
            window.print();
        }
    });
});
</script>
@endpush
