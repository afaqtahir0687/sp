<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name_en }} - Product Specification Sheet | Crelogics</title>

    <!-- Bootstrap 4 / FontAwesome for clean structure -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Google Fonts: Inter (EN) & Cairo (AR) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #25A6D9;
            --primary-dark: #0f172a;
            --secondary-dark: #1e293b;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #f1f5f9;
            color: #1e293b;
            padding: 30px 15px;
            margin: 0;
            -webkit-print-color-adjust: exact !important;
            print-color-adjust: exact !important;
        }

        /* Floating Top Action Bar (Non-Printable) */
        .pdf-action-bar {
            position: fixed;
            top: 15px;
            right: 20px;
            z-index: 9999;
            display: flex;
            align-items: center;
            gap: 10px;
            background: rgba(15, 23, 42, 0.92);
            backdrop-filter: blur(8px);
            padding: 8px 16px;
            border-radius: 50px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        .pdf-btn {
            border: none;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            padding: 7px 16px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none !important;
        }

        .pdf-btn-download {
            background-color: #e74a3b;
            color: #ffffff;
        }
        .pdf-btn-download:hover {
            background-color: #c0392b;
            color: #ffffff;
            transform: translateY(-1px);
        }

        .pdf-btn-print {
            background-color: #25A6D9;
            color: #ffffff;
        }
        .pdf-btn-print:hover {
            background-color: #1b8fb8;
            color: #ffffff;
            transform: translateY(-1px);
        }

        .pdf-btn-close {
            background-color: #475569;
            color: #ffffff;
        }
        .pdf-btn-close:hover {
            background-color: #334155;
            color: #ffffff;
        }

        /* A4 Page Layout Container */
        .sheet-container {
            max-width: 900px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            padding: 40px 45px;
            box-sizing: border-box;
        }

        /* Brand Header */
        .brand-icon {
            width: 46px;
            height: 46px;
            background: #eaf6fc;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-color);
        }

        /* Title Banner */
        .title-banner {
            background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
            border-radius: 8px;
            padding: 22px 26px;
            color: #ffffff;
            margin-bottom: 25px;
        }

        .arabic-text {
            font-family: 'Cairo', sans-serif !important;
        }

        .table-custom th {
            background-color: #f8fafc;
            color: #334155;
            font-weight: 600;
            border-top: none;
        }

        .spec-table th, .spec-table td {
            vertical-align: middle !important;
            padding: 10px 14px;
        }

        .spec-badge {
            font-size: 11px;
            padding: 4px 8px;
            border-radius: 4px;
            font-weight: 600;
        }

        /* Print Media Styles */
        @media print {
            body {
                background: #ffffff !important;
                padding: 0 !important;
                margin: 0 !important;
            }

            .pdf-action-bar, .no-print {
                display: none !important;
            }

            .sheet-container {
                max-width: 100% !important;
                width: 100% !important;
                margin: 0 !important;
                padding: 10mm 12mm !important;
                box-shadow: none !important;
                border-radius: 0 !important;
            }

            .title-banner {
                background: #1e293b !important;
                color: #ffffff !important;
            }

            @page {
                size: A4 portrait;
                margin: 8mm 6mm 8mm 6mm;
            }

            tr {
                page-break-inside: avoid;
            }
        }
    </style>
</head>
<body>

    <!-- Floating Top Bar -->
    <div class="pdf-action-bar no-print">
        <button type="button" class="pdf-btn pdf-btn-download" id="downloadPdfAction">
            <i class="fas fa-file-pdf"></i> Download PDF
        </button>
        <button type="button" class="pdf-btn pdf-btn-print" onclick="window.print()">
            <i class="fas fa-print"></i> Print / Save PDF
        </button>
        <button type="button" class="pdf-btn pdf-btn-close" onclick="window.close()">
            <i class="fas fa-times"></i> Close
        </button>
    </div>

    <!-- Main Printable Document Container -->
    <div id="pdfContentArea" class="sheet-container">

        <!-- 1. Header & Brand Information -->
        <div class="pb-3 mb-4 border-bottom">
            <div class="row align-items-center">
                <div class="col-6 text-left">
                    <div class="d-flex align-items-center mb-1">
                        <div class="brand-icon mr-3">
                            <i class="fas fa-cube fa-2x"></i>
                        </div>
                        <div>
                            <h3 class="mb-0 font-weight-bold text-dark" style="letter-spacing: 1px;">CRELOGICS</h3>
                            <div class="text-uppercase small font-weight-bold text-primary">Printing & Packaging Solutions</div>
                        </div>
                    </div>
                    <div class="small text-muted mt-2">
                        <div><strong>Technical Product Specification Sheet</strong></div>
                        <div>Ref: <code>CR-PRD-{{ str_pad($product->id, 5, '0', STR_PAD_LEFT) }}</code> | SKU: <strong>{{ $product->sku ?? 'N/A' }}</strong></div>
                    </div>
                </div>
                <div class="col-6 text-right" dir="rtl">
                    <div class="d-flex align-items-center justify-content-end mb-1">
                        <div>
                            <h3 class="mb-0 font-weight-bold text-dark arabic-text">كريلوجيكس</h3>
                            <div class="small font-weight-bold text-primary arabic-text">حلول الطباعة والتغليف المتكاملة</div>
                        </div>
                        <div class="brand-icon ml-3">
                            <i class="fas fa-print fa-2x"></i>
                        </div>
                    </div>
                    <div class="small text-muted mt-2 arabic-text">
                        <div><strong>وثيقة المواصفات الفنية المعتمدة للمنتج</strong></div>
                        <div>تاريخ الإصدار: <strong>{{ now()->format('Y-m-d') }}</strong> ({{ now()->format('h:i A') }})</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Bilingual Product Title Banner -->
        <div class="title-banner">
            <div class="row align-items-center">
                <div class="col-7 border-right">
                    <div class="text-uppercase small text-info font-weight-bold mb-1">
                        {{ $product->category ? $product->category->name_en : 'General Category' }}
                        @if($product->subcategory)
                            <i class="fas fa-chevron-right mx-1 fa-xs text-white-50"></i> {{ $product->subcategory->name_en }}
                        @endif
                    </div>
                    <h2 class="h4 font-weight-bold mb-2 text-white">{{ $product->name_en }}</h2>
                    <div class="d-flex flex-wrap align-items-center">
                        <span class="badge badge-{{ $product->status == 'active' ? 'success' : 'secondary' }} mr-2">
                            {{ ucfirst($product->status) }}
                        </span>
                        @if($product->is_featured)
                            <span class="badge badge-warning text-dark mr-2"><i class="fas fa-star mr-1"></i> Featured</span>
                        @endif
                        @if($product->is_new_arrival)
                            <span class="badge badge-info mr-2">New Arrival</span>
                        @endif
                    </div>
                </div>
                <div class="col-5 text-right" dir="rtl">
                    <div class="small text-info font-weight-bold mb-1 arabic-text">
                        {{ $product->category ? $product->category->name_ar : 'عام' }}
                        @if($product->subcategory)
                            <i class="fas fa-chevron-left mx-1 fa-xs text-white-50"></i> {{ $product->subcategory->name_ar }}
                        @endif
                    </div>
                    <h2 class="h4 font-weight-bold mb-2 text-white arabic-text">{{ $product->name_ar }}</h2>
                    <span class="badge badge-light text-dark arabic-text">
                        {{ $product->status == 'active' ? 'نشط ومعتمد للطلب' : 'غير متوفر' }}
                    </span>
                </div>
            </div>
        </div>

        <!-- 3. Financials & Key Turnaround Cards -->
        <div class="row mb-4">
            <div class="col-3">
                <div class="border rounded p-3 text-center bg-light">
                    <div class="small font-weight-bold text-primary text-uppercase mb-1">Base Price / الأساسي</div>
                    <div class="h5 mb-0 font-weight-bold text-dark">SAR {{ number_format((float)$product->price, 2) }}</div>
                    <small class="text-muted">Unit rate</small>
                </div>
            </div>
            <div class="col-3">
                <div class="border rounded p-3 text-center bg-light">
                    <div class="small font-weight-bold text-success text-uppercase mb-1">Discount / الخصم</div>
                    <div class="h5 mb-0 font-weight-bold text-dark">
                        @if($product->discount_price > 0)
                            SAR {{ number_format((float)$product->discount_price, 2) }}
                        @else
                            <span class="text-muted small">None</span>
                        @endif
                    </div>
                    <small class="text-muted">
                        {{ $product->discount_end_date ? \Carbon\Carbon::parse($product->discount_end_date)->format('d M Y') : 'Standard' }}
                    </small>
                </div>
            </div>
            <div class="col-3">
                <div class="border rounded p-3 text-center bg-light">
                    <div class="small font-weight-bold text-info text-uppercase mb-1">Production / مدة الإنتاج</div>
                    <div class="h5 mb-0 font-weight-bold text-dark">{{ $product->production_days ?? 3 }} Days</div>
                    <small class="text-muted">Flexible: {{ $product->flexible_production_days ?? 5 }}d | Urgent: {{ $product->urgent_production_days ?? 1 }}d</small>
                </div>
            </div>
            <div class="col-3">
                <div class="border rounded p-3 text-center bg-light">
                    <div class="small font-weight-bold text-warning text-uppercase mb-1">Delivery / التوصيل</div>
                    <div class="h5 mb-0 font-weight-bold text-dark">{{ $product->delivery_days ?? 1 }} Day(s)</div>
                    <small class="text-muted">Nationwide shipping</small>
                </div>
            </div>
        </div>

        <!-- 4. Product Media & Turnaround Schedule -->
        <div class="row mb-4 align-items-center">
            <div class="col-4 text-center">
                <div class="border p-2 rounded bg-white">
                    @php
                        $imgSrc = $mainImageDataUri ?? ($product->image ? asset('storage/' . $product->image) : asset('assets/images/placeholder.png'));
                    @endphp
                    <img src="{{ $imgSrc }}" alt="{{ $product->name_en }}" class="img-fluid rounded" style="max-height: 200px; object-fit: contain;">
                </div>
                @if(!empty($galleryDataUris))
                    <div class="d-flex justify-content-center mt-2">
                        @foreach($galleryDataUris as $gUri)
                            <img src="{{ $gUri }}" class="img-thumbnail mr-1" style="width: 42px; height: 42px; object-fit: cover;">
                        @endforeach
                    </div>
                @endif
            </div>
            <div class="col-8">
                <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-2">
                    <i class="fas fa-clock text-primary mr-1"></i> Production & Urgency Matrix / جداول الإنتاج ومواعيد التسليم
                </h6>
                <table class="table table-bordered table-sm mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th>Urgency Schedule</th>
                            <th>Turnaround Time</th>
                            <th>Unit Rate (SAR)</th>
                            <th class="text-right" dir="rtl">المدة وسعر الوحدة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong><i class="fas fa-check text-primary mr-1"></i> Regular (عادي)</strong></td>
                            <td>{{ $product->production_days ?? 3 }} Business Days</td>
                            <td>SAR {{ number_format((float)$product->price, 2) }}</td>
                            <td class="text-right arabic-text" dir="rtl">{{ $product->production_days ?? 3 }} أيام عمل (أساسي)</td>
                        </tr>
                        <tr>
                            <td><strong><i class="fas fa-calendar-alt text-info mr-1"></i> Flexible (مرن)</strong></td>
                            <td>{{ $product->flexible_production_days ?? 5 }} Business Days</td>
                            <td>SAR {{ number_format((float)($product->flexible_rate > 0 ? $product->flexible_rate : $product->price), 2) }}</td>
                            <td class="text-right arabic-text" dir="rtl">{{ $product->flexible_production_days ?? 5 }} أيام عمل (سعر اقتصادي)</td>
                        </tr>
                        <tr>
                            <td><strong><i class="fas fa-bolt text-warning mr-1"></i> Urgent (مستعجل)</strong></td>
                            <td>{{ $product->urgent_production_days ?? 1 }} Business Day(s)</td>
                            <td>SAR {{ number_format((float)($product->urgent_rate > 0 ? $product->urgent_rate : $product->price), 2) }}</td>
                            <td class="text-right arabic-text" dir="rtl">{{ $product->urgent_production_days ?? 1 }} يوم عمل سريع</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- 5. Complete Specifications Table -->
        <div class="mb-4">
            <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-2">
                <i class="fas fa-sliders-h text-primary mr-1"></i> Customization Specifications / المواصفات والخيارات الفنية
            </h6>
            <table class="table table-bordered table-striped spec-table table-sm mb-0">
                <thead class="bg-dark text-white">
                    <tr>
                        <th style="width: 25%;">Feature / الميزة</th>
                        <th style="width: 37%;">English Specification</th>
                        <th style="width: 38%;" class="text-right" dir="rtl">المواصفات بالعربية</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Quantities -->
                    <tr>
                        <td class="font-weight-bold bg-light">Quantities (الكميات)</td>
                        <td>
                            {{ !empty($product->quantities) && is_array($product->quantities) ? implode(', ', $product->quantities) : 'Not specified' }}
                            @if($product->allow_custom_quantity)
                                <div class="small text-success font-weight-bold">Custom Quantity Allowed</div>
                            @endif
                        </td>
                        <td class="text-right arabic-text" dir="rtl">
                            {{ !empty($product->quantities) && is_array($product->quantities) ? implode(' ، ', $product->quantities) : 'غير محدد' }}
                            @if($product->allow_custom_quantity)
                                <div class="small text-success font-weight-bold">مسموح بإدخال كمية مخصصة</div>
                            @endif
                        </td>
                    </tr>

                    <!-- Sizes -->
                    <tr>
                        <td class="font-weight-bold bg-light">Sizes (المقاسات)</td>
                        <td>{{ !empty($product->sizes) && is_array($product->sizes) ? implode(', ', $product->sizes) : 'Standard Size' }}</td>
                        <td class="text-right arabic-text" dir="rtl">{{ !empty($product->sizes_ar) && is_array($product->sizes_ar) ? implode(' ، ', $product->sizes_ar) : 'مقاس قياسي' }}</td>
                    </tr>

                    <!-- Colors -->
                    <tr>
                        <td class="font-weight-bold bg-light">Colors (الألوان)</td>
                        <td>{{ !empty($product->side_1_colors) && is_array($product->side_1_colors) ? implode(', ', $product->side_1_colors) : 'Full Color (CMYK)' }}</td>
                        <td class="text-right arabic-text" dir="rtl">{{ !empty($product->side_1_colors_ar) && is_array($product->side_1_colors_ar) ? implode(' ، ', $product->side_1_colors_ar) : 'طباعة ملونة كاملة (CMYK)' }}</td>
                    </tr>

                    <!-- Sides -->
                    <tr>
                        <td class="font-weight-bold bg-light">Sides Options (الأوجه)</td>
                        <td>{{ !empty($product->sides_options) && is_array($product->sides_options) ? implode(', ', $product->sides_options) : '1, 2' }}</td>
                        <td class="text-right arabic-text" dir="rtl">{{ !empty($product->sides_options_ar) && is_array($product->sides_options_ar) ? implode(' ، ', $product->sides_options_ar) : 'وجه واحد ، وجهين' }}</td>
                    </tr>

                    <!-- Lamination -->
                    <tr>
                        <td class="font-weight-bold bg-light">Lamination (التغليف)</td>
                        <td>
                            <div>{{ !empty($product->lamination_types) && is_array($product->lamination_types) ? implode(', ', $product->lamination_types) : 'No lamination configured' }}</div>
                            <small class="text-muted">Unit Surcharge: SAR {{ number_format((float)($product->lamination_price ?? 0), 2) }} (2 sides)</small>
                        </td>
                        <td class="text-right arabic-text" dir="rtl">
                            <div>{{ !empty($product->lamination_types_ar) && is_array($product->lamination_types_ar) ? implode(' ، ', $product->lamination_types_ar) : 'بدون خيارات تغليف' }}</div>
                            <small class="text-muted">سعر التغليف: {{ number_format((float)($product->lamination_price ?? 0), 2) }} ريال (وجهين)</small>
                        </td>
                    </tr>

                    <!-- Die Cutting -->
                    <tr>
                        <td class="font-weight-bold bg-light">Die Cutting & Corners (القص والزوايا)</td>
                        <td>
                            <div>{{ !empty($product->die_cutting_options) && is_array($product->die_cutting_options) ? implode(', ', $product->die_cutting_options) : 'Standard Cut' }}</div>
                            @if($product->allow_round_corners)
                                <small class="text-success font-weight-bold">Round Corners Available</small>
                            @endif
                        </td>
                        <td class="text-right arabic-text" dir="rtl">
                            <div>{{ !empty($product->die_cutting_options_ar) && is_array($product->die_cutting_options_ar) ? implode(' ، ', $product->die_cutting_options_ar) : 'قص مستقيم قياسي' }}</div>
                            @if($product->allow_round_corners)
                                <small class="text-success font-weight-bold">إمكانية زوايا مستديرة (Round Corners)</small>
                            @endif
                        </td>
                    </tr>

                    @if(!empty($product->orientations) || !empty($product->orientations_ar))
                    <tr>
                        <td class="font-weight-bold bg-light">Orientation (الاتجاه)</td>
                        <td>{{ is_array($product->orientations) ? implode(', ', $product->orientations) : $product->orientations }}</td>
                        <td class="text-right arabic-text" dir="rtl">{{ is_array($product->orientations_ar) ? implode(' ، ', $product->orientations_ar) : $product->orientations_ar }}</td>
                    </tr>
                    @endif

                    @if(!empty($product->folding_options) || !empty($product->folding_options_ar))
                    <tr>
                        <td class="font-weight-bold bg-light">Folding (الطي)</td>
                        <td>{{ is_array($product->folding_options) ? implode(', ', $product->folding_options) : $product->folding_options }}</td>
                        <td class="text-right arabic-text" dir="rtl">{{ is_array($product->folding_options_ar) ? implode(' ، ', $product->folding_options_ar) : $product->folding_options_ar }}</td>
                    </tr>
                    @endif

                    @if(!empty($product->binding_options) || !empty($product->binding_options_ar))
                    <tr>
                        <td class="font-weight-bold bg-light">Binding (التجليد)</td>
                        <td>{{ is_array($product->binding_options) ? implode(', ', $product->binding_options) : $product->binding_options }}</td>
                        <td class="text-right arabic-text" dir="rtl">{{ is_array($product->binding_options_ar) ? implode(' ، ', $product->binding_options_ar) : $product->binding_options_ar }}</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- 6. Materials & Rates Matrix -->
        @php
            $materials = $product->materials ?? [];
            $materialsAr = $product->materials_ar ?? [];
            $materialPrices = $product->material_prices ?? [];
        @endphp
        @if(!empty($materials) && is_array($materials))
        <div class="mb-4">
            <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-2">
                <i class="fas fa-boxes text-primary mr-1"></i> Paper Stock & Material Rates / أنواع الورق والأسعار
            </h6>
            <table class="table table-bordered table-sm mb-0">
                <thead class="bg-light">
                    <tr>
                        <th style="width: 5%;">#</th>
                        <th style="width: 42%;">Material (English)</th>
                        <th style="width: 35%;" class="text-right" dir="rtl">نوع الخامة / الورق (بالعربية)</th>
                        <th style="width: 18%;" class="text-right">Unit Rate (SAR)</th>
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
                            <td><strong>{{ $mat }}</strong></td>
                            <td class="text-right arabic-text" dir="rtl">{{ $matAr }}</td>
                            <td class="text-right font-weight-bold {{ $hasCustomPrice ? 'text-success' : 'text-dark' }}">
                                SAR {{ number_format((float)$matRate, 2) }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

        <!-- 7. Bilingual Descriptions & Documentation -->
        <div class="mb-4">
            <h6 class="font-weight-bold text-dark border-bottom pb-2 mb-2">
                <i class="fas fa-align-left text-primary mr-1"></i> Product Descriptions & Specifications / الوصف الفني والتعليمات
            </h6>

            <!-- Short Description -->
            <div class="border rounded p-3 mb-3 bg-light">
                <div class="row">
                    <div class="col-6 border-right">
                        <strong class="d-block mb-1 text-primary">Summary (English)</strong>
                        <p class="mb-0 text-dark small">{{ $product->short_description_en ?: 'No English summary.' }}</p>
                    </div>
                    <div class="col-6 text-right" dir="rtl">
                        <strong class="d-block mb-1 text-primary arabic-text">نبذة مختصرة (بالعربية)</strong>
                        <p class="mb-0 text-dark small arabic-text">{{ $product->short_description_ar ?: 'لا يوجد نبذة بالعربية.' }}</p>
                    </div>
                </div>
            </div>

            <!-- Full Description -->
            <div class="border rounded p-3 mb-3">
                <div class="row">
                    <div class="col-6 border-right">
                        <strong class="d-block mb-1 text-dark">Full Description (English)</strong>
                        <div class="small text-muted">{!! $product->description_en ?: 'No detailed description.' !!}</div>
                    </div>
                    <div class="col-6 text-right" dir="rtl">
                        <strong class="d-block mb-1 text-dark arabic-text">الوصف التفصيلي (بالعربية)</strong>
                        <div class="small text-muted arabic-text">{!! $product->description_ar ?: 'لا يوجد وصف تفصيلي.' !!}</div>
                    </div>
                </div>
            </div>

            <!-- Size Guide & Technical Info -->
            <div class="row">
                <div class="col-6">
                    <div class="border rounded p-3 h-100">
                        <strong class="d-block mb-1 text-info">Size Guide / دليل المقاسات</strong>
                        <div class="small text-muted mb-2">{!! $product->size_guide_en ?: 'Standard sizing.' !!}</div>
                        <div class="small text-muted text-right arabic-text" dir="rtl">{!! $product->size_guide_ar ?: 'المقاسات المعتمدة.' !!}</div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="border rounded p-3 h-100">
                        <strong class="d-block mb-1 text-info">Artwork & Bleed Guidelines / متطلبات التصميم</strong>
                        <div class="small text-muted mb-2">{!! $product->additional_info_en ?: '3mm bleed, CMYK, 300 DPI.' !!}</div>
                        <div class="small text-muted text-right arabic-text" dir="rtl">{!! $product->additional_info_ar ?: 'مواصفات الطباعة القياسية.' !!}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 8. Document Footer -->
        <div class="pt-3 mt-4 border-top text-muted small">
            <div class="row align-items-center">
                <div class="col-6 text-left">
                    <div><strong>Crelogics Printing & Packaging Solutions</strong></div>
                    <div>Website: <a href="http://sp.crelogics.com">http://sp.crelogics.com</a> | Riyadh, KSA</div>
                    <div class="text-muted mt-1">&copy; {{ date('Y') }} Crelogics. All rights reserved.</div>
                </div>
                <div class="col-6 text-right arabic-text" dir="rtl">
                    <div><strong>كريلوجيكس لحلول الطباعة والتغليف</strong></div>
                    <div>المملكة العربية السعودية | الرياض</div>
                    <div class="text-muted mt-1">تم إصدار الوثيقة إلكترونياً من نظام المنتجات وهي معتمدة فنياً.</div>
                </div>
            </div>
        </div>

    </div>

    <!-- html2pdf.js for 1-click Download -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        document.getElementById('downloadPdfAction').addEventListener('click', function() {
            var btn = this;
            var origHtml = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Generating...';
            btn.disabled = true;

            var element = document.getElementById('pdfContentArea');
            var productName = "{{ Str::slug($product->name_en) }}";
            var filename = 'Crelogics-' + {{ $product->id }} + '-' + (productName || 'Product') + '.pdf';

            var opt = {
                margin:       [6, 6, 6, 6],
                filename:     filename,
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { scale: 2, useCORS: true, letterRendering: true },
                jsPDF:        { unit: 'mm', format: 'a4', orientation: 'portrait' },
                pagebreak:    { mode: ['avoid-all', 'css', 'legacy'] }
            };

            if (typeof html2pdf !== 'undefined') {
                html2pdf().set(opt).from(element).save().then(function() {
                    btn.innerHTML = origHtml;
                    btn.disabled = false;
                }).catch(function(err) {
                    console.error("PDF error:", err);
                    btn.innerHTML = origHtml;
                    btn.disabled = false;
                    window.print();
                });
            } else {
                btn.innerHTML = origHtml;
                btn.disabled = false;
                window.print();
            }
        });

        // Auto print if query param autoprint=1
        if (window.location.search.indexOf('autoprint=1') !== -1) {
            window.onload = function() {
                window.print();
            };
        }
    </script>
</body>
</html>
