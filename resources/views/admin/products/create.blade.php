@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <!-- Left Column -->
                <div class="col-lg-8">
                    <!-- General Information -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle mr-1"></i> General
                                Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Product Name (English) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name_en" class="form-control" placeholder="Enter product name"
                                            required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label class="font-weight-bold">Product Name (Arabic) <span
                                                class="text-danger">*</span></label>
                                        <input type="text" name="name_ar" class="form-control" placeholder="Enter product name in Arabic"
                                            required dir="rtl">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label class="font-weight-bold">SKU</label>
                                        <input type="text" name="sku" class="form-control" placeholder="SKU code">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Category <span class="text-danger">*</span></label>
                                        <select name="category_id" id="category_id" class="form-control" required>
                                            <option value="">Select Category</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Subcategory</label>
                                        <select name="subcategory_id" id="subcategory_id" class="form-control">
                                            <option value="">Select Subcategory</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Descriptions -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-align-left mr-1"></i> Content &
                                Descriptions</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="font-weight-bold">Short Description (English)</label>
                                <textarea name="short_description_en" class="form-control" rows="2"
                                    placeholder="Brief overview of the product"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Short Description (Arabic)</label>
                                <textarea name="short_description_ar" class="form-control" rows="2"
                                    placeholder="Brief overview of the product in Arabic" dir="rtl"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Full Description (English)</label>
                                <textarea name="description_en" class="form-control" rows="5"
                                    placeholder="Detailed product specifications"></textarea>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Full Description (Arabic)</label>
                                <textarea name="description_ar" class="form-control" rows="5"
                                    placeholder="Detailed product specifications in Arabic" dir="rtl"></textarea>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Size Guide (English)</label>
                                        <textarea name="size_guide_en" class="form-control" rows="3"
                                            placeholder="HTML or text for size guide"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Size Guide (Arabic)</label>
                                        <textarea name="size_guide_ar" class="form-control" rows="3"
                                            placeholder="HTML or text for size guide in Arabic" dir="rtl"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Additional Info (English)</label>
                                        <textarea name="additional_info_en" class="form-control" rows="3"
                                            placeholder="Technical/Shipping details"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Additional Info (Arabic)</label>
                                        <textarea name="additional_info_ar" class="form-control" rows="3"
                                            placeholder="Technical/Shipping details in Arabic" dir="rtl"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Customization Options -->
                    <div class="card shadow mb-4" id="customization_card">
                        <div class="card-header py-3 d-flex flex-wrap justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">
                                <i class="fas fa-sliders-h mr-1"></i> Customization Options (Comma separated)
                            </h6>
                            
                            <!-- Dynamic Copy Options from Database Products Dropdown -->
                            <div class="dropdown mt-2 mt-md-0" id="dynamicProductOptionsDropdownContainer">
                                <button class="btn btn-sm btn-primary dropdown-toggle shadow-sm px-3 py-2 font-weight-bold text-white d-flex align-items-center" 
                                        type="button" id="loadProductOptionsDropdownButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" 
                                        style="border-radius: 6px; font-size: 0.85rem; letter-spacing: 0.3px;">
                                    <i class="fas fa-database mr-2"></i> Copy Options from Existing Product <i class="fas fa-chevron-down ml-2 small"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right shadow-lg p-2 border-0" 
                                     aria-labelledby="loadProductOptionsDropdownButton" 
                                     style="min-width: 380px; max-width: 440px; border-radius: 10px; box-shadow: 0 10px 30px rgba(0,0,0,0.18) !important; z-index: 1050;">
                                    
                                    <!-- Search filter inside dynamic dropdown -->
                                    <div class="p-2 mb-2 bg-light rounded">
                                        <div class="input-group input-group-sm">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-white border-right-0 text-muted"><i class="fas fa-search"></i></span>
                                            </div>
                                            <input type="text" class="form-control border-left-0" id="search_existing_product_filter" 
                                                   placeholder="Search product from database..." autocomplete="off" style="font-size: 0.82rem;">
                                        </div>
                                    </div>
                                    
                                    <div class="dropdown-header px-2 py-1 text-uppercase text-muted font-weight-bold d-flex justify-content-between align-items-center" style="font-size: 0.7rem;">
                                        <span>Products in Database ({{ $existingProducts->count() }}):</span>
                                        <small class="text-primary font-weight-bold"><i class="fas fa-sync-alt mr-1"></i>Dynamic DB</small>
                                    </div>
                                    
                                    <div id="dynamic_products_list_scroll" style="max-height: 280px; overflow-y: auto;">
                                        @forelse($existingProducts as $p)
                                            <a class="dropdown-item dynamic-product-select-item d-flex align-items-center py-2 px-2 rounded mb-1 text-decoration-none" 
                                               href="javascript:void(0)" 
                                               data-product-id="{{ $p->id }}" 
                                               data-product-name="{{ $p->name_en }}">
                                                <div class="mr-2 text-white rounded d-flex align-items-center justify-content-center" 
                                                     style="width: 32px; height: 32px; background: #25A6D9; flex-shrink: 0; font-size: 0.75rem;">
                                                    <i class="fas fa-box"></i>
                                                </div>
                                                <div class="text-truncate flex-grow-1">
                                                    <div class="font-weight-bold text-dark text-truncate" style="font-size: 0.85rem;">{{ $p->name_en }}</div>
                                                    <small class="text-muted d-block text-truncate" style="font-size: 0.72rem;">
                                                        @if($p->category) <span class="badge badge-light border text-muted mr-1">{{ $p->category->name_en }}</span> @endif
                                                        {{ $p->name_ar ? $p->name_ar : '' }}
                                                    </small>
                                                </div>
                                            </a>
                                        @empty
                                            <div class="text-center text-muted small py-3">
                                                <i class="fas fa-info-circle mr-1"></i> No products with options in database.
                                            </div>
                                        @endforelse
                                    </div>
                                    <div id="no_dynamic_product_matched" class="text-center text-muted small py-2 d-none">
                                        <i class="fas fa-search mr-1"></i> No matching product found in database.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <!-- Category Auto-Suggestion Alert -->
                            <div id="category_options_alert" class="alert alert-info py-2 px-3 mb-3 d-none align-items-center justify-content-between shadow-sm" style="border-radius: 8px;">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-lightbulb text-warning fa-lg mr-2"></i>
                                    <div>
                                        <span class="font-weight-bold" id="category_options_alert_text">Found existing options for this category!</span>
                                        <small class="d-block text-muted" id="category_options_alert_sub">Would you like to auto-fill options from the database for this category?</small>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button type="button" class="btn btn-sm btn-primary px-3 mr-2 font-weight-bold shadow-sm" id="btn_apply_category_options">
                                        <i class="fas fa-magic mr-1"></i> Auto-fill Options
                                    </button>
                                    <button type="button" class="close text-muted" id="btn_dismiss_category_alert" aria-label="Close" style="outline: none;">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>

                            <div id="dynamic_loaded_badge" class="alert alert-success py-2 px-3 mb-3 font-weight-bold" style="display:none; border-radius: 8px;">
                                <i class="fas fa-check-circle mr-1"></i> Options loaded successfully!
                            </div>
                            <!-- Quick Search Filter for Option Fields -->
                            <div class="mb-3 p-2 bg-light rounded border d-flex flex-wrap align-items-center justify-content-between">
                                <div class="input-group input-group-sm mr-2 flex-grow-1" style="max-width: 450px;">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-white border-right-0 text-muted"><i class="fas fa-filter"></i></span>
                                    </div>
                                    <input type="text" id="quick_filter_fields" class="form-control border-left-0" 
                                           placeholder="Filter options (e.g. material, folding, binding, lamination, die cutting, size)...">
                                    <div class="input-group-append" id="clear_filter_wrapper" style="display:none;">
                                        <button class="btn btn-outline-secondary btn-sm" type="button" id="clear_filter_fields" title="Clear filter">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <small class="text-muted font-weight-bold mt-1 mt-sm-0" id="filter_stats_badge">
                                    <i class="fas fa-check-circle text-success mr-1"></i> All options visible
                                </small>
                            </div>

                            <!-- Materials -->
                            <div class="row option-row">
                                <div class="col-md-6">
                                    <div class="form-group option-field-group">
                                        <label class="font-weight-bold">Materials (English) <small class="text-muted">(Comma separated)</small></label>
                                        <input type="text" name="materials" id="input_materials" class="form-control"
                                            placeholder="e.g. 200 Coated Matt --, 250 Coated Matt --, 350 Coated Matt --, 400 Invercoat">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group option-field-group">
                                        <label class="font-weight-bold">Materials (Arabic)</label>
                                        <input type="text" name="materials_ar" id="input_materials_ar" class="form-control"
                                            placeholder="e.g. 200 مطلي مطفي, 350 مطلي مطفي, 400 إنفركوت" dir="rtl">
                                    </div>
                                </div>
                            </div>

                            <!-- Per-Material Pricing Container -->
                            <div class="card bg-light border-0 mb-3 option-row" id="material_prices_card">
                                <div class="card-header bg-white border d-flex flex-wrap justify-content-between align-items-center py-2">
                                    <span class="font-weight-bold text-dark" style="font-size: 0.9rem;">
                                        <i class="fas fa-calculator text-primary mr-1"></i> Per-Material Specific Unit Prices (Optional)
                                    </span>
                                    <div class="input-group input-group-sm mt-1 mt-md-0" style="max-width: 250px;">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-light text-muted border-right-0"><i class="fas fa-search"></i></span>
                                        </div>
                                        <input type="text" id="filter_material_price_inputs" class="form-control border-left-0" placeholder="Filter material price...">
                                    </div>
                                </div>
                                <div class="card-body border border-top-0 bg-white py-2" id="material_prices_wrapper">
                                    <div class="row" id="material_prices_list">
                                        <div class="col-12 text-muted small py-1" id="no_materials_notice">Enter materials above to configure individual material pricing.</div>
                                    </div>
                                </div>
                            </div>

                            <!-- Sizes & Colors -->
                            <div class="row option-row">
                                <div class="col-md-3">
                                    <div class="form-group option-field-group">
                                        <label class="font-weight-bold">Sizes (English)</label>
                                        <input type="text" name="sizes" id="input_sizes" class="form-control" placeholder="e.g. B-Cards, A4">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group option-field-group">
                                        <label class="font-weight-bold">Sizes (Arabic)</label>
                                        <input type="text" name="sizes_ar" id="input_sizes_ar" class="form-control" placeholder="e.g. بطاقات, A4" dir="rtl">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group option-field-group">
                                        <label class="font-weight-bold">Side 1 Colors (English)</label>
                                        <input type="text" name="side_1_colors" id="input_colors" class="form-control" placeholder="e.g. CMYK">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group option-field-group">
                                        <label class="font-weight-bold">Side 1 Colors (Arabic)</label>
                                        <input type="text" name="side_1_colors_ar" id="input_colors_ar" class="form-control" placeholder="e.g. CMYK" dir="rtl">
                                    </div>
                                </div>
                            </div>

                            <!-- Printing Sides & Lamination -->
                            <div class="row option-row">
                                <div class="col-md-3">
                                    <div class="form-group option-field-group">
                                        <label class="font-weight-bold">Printing Sides (English)</label>
                                        <input type="text" name="sides_options" id="input_sides" class="form-control" placeholder="e.g. 1, 2">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group option-field-group">
                                        <label class="font-weight-bold">Printing Sides (Arabic)</label>
                                        <input type="text" name="sides_options_ar" id="input_sides_ar" class="form-control" placeholder="e.g. 1, 2" dir="rtl">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group option-field-group">
                                        <label class="font-weight-bold">Lamination Types (EN)</label>
                                        <input type="text" name="lamination_types" id="input_lamination" class="form-control" placeholder="e.g. SF Matt Lamination -, SF Gloss Lamination -">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group option-field-group">
                                        <label class="font-weight-bold">Lamination Types (AR)</label>
                                        <input type="text" name="lamination_types_ar" id="input_lamination_ar" class="form-control" placeholder="e.g. تغليف مطفي, تغليف لامع" dir="rtl">
                                    </div>
                                </div>
                            </div>

                            <!-- Lamination Surcharge & Die Cutting -->
                            <div class="row option-row">
                                <div class="col-md-4">
                                    <div class="form-group option-field-group">
                                        <label class="font-weight-bold">Lamination Extra Cost (Unit/Item)</label>
                                        <input type="number" step="0.01" name="lamination_price" class="form-control" placeholder="e.g. 0.05 (leave blank for automatic ~25%)">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group option-field-group">
                                        <label class="font-weight-bold">Die Cutting (English)</label>
                                        <input type="text" name="die_cutting_options" id="input_die_cutting" class="form-control" placeholder="e.g. Standard Cut, Round Corners, Custom Shape">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group option-field-group">
                                        <label class="font-weight-bold">Die Cutting (Arabic)</label>
                                        <input type="text" name="die_cutting_options_ar" id="input_die_cutting_ar" class="form-control" placeholder="e.g. قص قياسي, زوايا دائرية" dir="rtl">
                                    </div>
                                </div>
                            </div>

                            <!-- Category Specific Options: Orientation, Folding, Binding -->
                            <div class="border-top pt-3 mt-2 option-row">
                                <h6 class="font-weight-bold text-secondary mb-3"><i class="fas fa-layer-group mr-1"></i> Additional Category Options (Flyers, Brochures, Books, Stationery)</h6>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group option-field-group">
                                            <label class="font-weight-bold">Orientations (English)</label>
                                            <input type="text" name="orientations" id="input_orientations" class="form-control" placeholder="e.g. Vertical (Portrait), Horizontal (Landscape)">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group option-field-group">
                                            <label class="font-weight-bold">Orientations (Arabic)</label>
                                            <input type="text" name="orientations_ar" id="input_orientations_ar" class="form-control" placeholder="e.g. عمودي, أفقي" dir="rtl">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group option-field-group">
                                            <label class="font-weight-bold">Folding Options (English)</label>
                                            <input type="text" name="folding_options" id="input_folding" class="form-control" placeholder="e.g. No Fold, Half Fold, Tri-Fold, Z-Fold">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group option-field-group">
                                            <label class="font-weight-bold">Folding Options (Arabic)</label>
                                            <input type="text" name="folding_options_ar" id="input_folding_ar" class="form-control" placeholder="e.g. بدون طي, طي نصفي, طي ثلاثي" dir="rtl">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group option-field-group">
                                            <label class="font-weight-bold">Binding Options (English)</label>
                                            <input type="text" name="binding_options" id="input_binding" class="form-control" placeholder="e.g. Loose Sheets, 50 Sheets per pad, 100 Sheets per pad, Saddle Stitch">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group option-field-group">
                                            <label class="font-weight-bold">Binding Options (Arabic)</label>
                                            <input type="text" name="binding_options_ar" id="input_binding_ar" class="form-control" placeholder="e.g. أوراق مفردة, دفتر 50 ورقة, دفتر 100 ورقة" dir="rtl">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Quantities & Flags -->
                            <div class="row border-top pt-3 mt-2 option-row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Allowed Quantities (Comma separated)</label>
                                        <input type="text" name="quantities" id="input_quantities" class="form-control" placeholder="e.g. 100, 250, 500, 1000">
                                        <small class="form-text text-muted">Leave empty to use default quantities.</small>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-0 mt-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="allow_custom_quantity"
                                                name="allow_custom_quantity" checked>
                                            <label class="custom-control-label font-weight-bold"
                                                for="allow_custom_quantity">Allow Custom Quantity</label>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0 mt-2">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="allow_round_corners"
                                                name="allow_round_corners">
                                            <label class="custom-control-label font-weight-bold"
                                                for="allow_round_corners">Allow Round Corners</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="col-lg-4">
                    <!-- Pricing & Urgency -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-money-bill-wave mr-1"></i>
                                Pricing & Delivery</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="font-weight-bold">Base Price <span class="text-danger">*</span></label>
                                <input type="number" step="0.01" name="price" id="admin_price" class="form-control" required>
                                <div class="mt-1"><span class="badge badge-success font-weight-bold text-white px-2 py-1" id="price_sar_display" style="display:none; font-size: 0.85rem;"></span></div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Discount Price</label>
                                <input type="number" step="0.01" name="discount_price" id="admin_discount_price" class="form-control">
                                <div class="mt-1"><span class="badge badge-success font-weight-bold text-white px-2 py-1" id="discount_price_sar_display" style="display:none; font-size: 0.85rem;"></span></div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Discount End Date</label>
                                <input type="date" name="discount_end_date" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold small">Production (Reg)</label>
                                        <input type="number" name="production_days" class="form-control" value="3">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold small">Delivery</label>
                                        <input type="number" name="delivery_days" class="form-control" value="1">
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold small">Flex Rate</label>
                                        <input type="number" step="0.01" name="flexible_rate" id="admin_flexible_rate" class="form-control">
                                        <div class="mt-1"><span class="badge badge-success font-weight-bold text-white px-2 py-1" id="flexible_rate_sar_display" style="display:none; font-size: 0.8rem;"></span></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold small">Flex Days</label>
                                        <input type="number" name="flexible_production_days" class="form-control" value="5">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold small">Urgent Rate</label>
                                        <input type="number" step="0.01" name="urgent_rate" id="admin_urgent_rate" class="form-control">
                                        <div class="mt-1"><span class="badge badge-success font-weight-bold text-white px-2 py-1" id="urgent_rate_sar_display" style="display:none; font-size: 0.8rem;"></span></div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label class="font-weight-bold small">Urgent Days</label>
                                        <input type="number" name="urgent_production_days" class="form-control" value="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Media & Settings -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cog mr-1"></i> Media & Visibility
                            </h6>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label class="font-weight-bold">Main Image <span class="text-danger">*</span></label>
                                <input type="file" name="image" class="form-control-file border p-1 rounded w-100" required>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Gallery Images</label>
                                <input type="file" name="images[]" class="form-control-file border p-1 rounded w-100"
                                    multiple id="gallery-images-input">
                                <div id="new-images-preview" class="mt-2 d-flex flex-wrap gap-2"></div>
                            </div>
                            <hr>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured">
                                    <label class="custom-control-label font-weight-bold" for="is_featured">Featured
                                        Product</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_new_arrival"
                                        name="is_new_arrival">
                                    <label class="custom-control-label font-weight-bold" for="is_new_arrival">New
                                        Arrival</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="is_wishlist" name="is_wishlist">
                                    <label class="custom-control-label font-weight-bold" for="is_wishlist">Show in
                                        Wishlist</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="font-weight-bold">Status</label>
                                <select name="status" class="form-control">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary btn-block btn-lg mt-4"><i
                                    class="fas fa-save mr-1"></i> Create Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function () {
                // Real-time SAR price calculation
                const sarRate = {{ get_latest_currency_rates()['SAR'] ?? 3.75 }};
                
                function updateSarPrice(inputSelector, displaySelector) {
                    var val = parseFloat($(inputSelector).val());
                    if (!isNaN(val) && val > 0) {
                        var sarVal = (val * sarRate).toFixed(2);
                        $(displaySelector).text('SAR: ' + sarVal + ' (1 USD = ' + sarRate.toFixed(2) + ' SAR)').show();
                    } else {
                        $(displaySelector).hide();
                    }
                }

                $('#admin_price').on('input', function() { updateSarPrice('#admin_price', '#price_sar_display'); });
                $('#admin_discount_price').on('input', function() { updateSarPrice('#admin_discount_price', '#discount_price_sar_display'); });
                $('#admin_flexible_rate').on('input', function() { updateSarPrice('#admin_flexible_rate', '#flexible_rate_sar_display'); });
                $('#admin_urgent_rate').on('input', function() { updateSarPrice('#admin_urgent_rate', '#urgent_rate_sar_display'); });

                // Trigger on load for non-empty values
                updateSarPrice('#admin_price', '#price_sar_display');
                updateSarPrice('#admin_discount_price', '#discount_price_sar_display');
                updateSarPrice('#admin_flexible_rate', '#flexible_rate_sar_display');
                updateSarPrice('#admin_urgent_rate', '#urgent_rate_sar_display');

                $('#category_id').change(function () {
                    var category_id = $(this).val();
                    if (category_id) {
                        $.ajax({
                            url: "{{ route('admin.get-subcategories') }}/" + category_id,
                            type: "GET",
                            dataType: "json",
                            success: function (data) {
                                $('#subcategory_id').empty();
                                $('#subcategory_id').append('<option value="">Select Subcategory</option>');
                                $.each(data, function (key, value) {
                                    $('#subcategory_id').append('<option value="' + value.id + '">' + value.name_en + '</option>');
                                });
                            }
                        });
                    } else {
                        $('#subcategory_id').empty();
                        $('#subcategory_id').append('<option value="">Select Subcategory</option>');
                    }
                });

                // Gallery images preview
                $('#gallery-images-input').on('change', function(e) {
                    var files = e.target.files;
                    var previewContainer = $('#new-images-preview');
                    previewContainer.empty();

                    if (files.length > 0) {
                        for (var i = 0; i < files.length; i++) {
                            var file = files[i];
                            var reader = new FileReader();

                            reader.onload = function(e) {
                                var previewHtml = `
                                    <div class="position-relative">
                                        <img src="${e.target.result}" width="80" height="80" class="rounded border shadow-sm">
                                        <button type="button" class="btn btn-danger btn-sm position-absolute" style="top: -8px; right: -8px; border-radius: 50%; width: 24px; height: 24px; padding: 0; display: flex; align-items: center; justify-content: center;">×</button>
                                    </div>
                                `;
                                previewContainer.append(previewHtml);
                            };

                            reader.readAsDataURL(file);
                        }
                    }
                });

                // Remove preview image on click
                $(document).on('click', '#new-images-preview button', function() {
                    $(this).parent().remove();
                });

                // Sync material prices table whenever materials input changes
                function syncMaterialPrices() {
                    let materialsStr = $('#input_materials').val();
                    let materials = materialsStr ? materialsStr.split(',').map(s => s.trim()).filter(s => s.length > 0) : [];
                    let $list = $('#material_prices_list');

                    let existingValues = {};
                    $list.find('input[name^="material_prices"]').each(function() {
                        let name = $(this).attr('name');
                        let mat = name.replace('material_prices[', '').replace(']', '');
                        existingValues[mat] = $(this).val();
                    });

                    $list.empty();
                    if (materials.length === 0) {
                        $list.html('<div class="col-12 text-muted small py-1" id="no_materials_notice">Enter materials above to configure individual material pricing.</div>');
                        return;
                    }

                    materials.forEach(function(mat) {
                        let val = existingValues[mat] !== undefined ? existingValues[mat] : '';
                        let itemHtml = `
                            <div class="col-md-4 col-sm-6 mb-2 material-price-item">
                                <label class="small text-truncate d-block mb-1 font-weight-bold" title="${mat}">${mat}</label>
                                <div class="input-group input-group-sm">
                                    <div class="input-group-prepend"><span class="input-group-text">SAR</span></div>
                                    <input type="number" step="0.01" class="form-control" name="material_prices[${mat}]" value="${val}" placeholder="Auto rate">
                                </div>
                            </div>
                        `;
                        $list.append(itemHtml);
                    });
                }

                $('#input_materials').on('blur change', syncMaterialPrices);

                // Function to apply product options data dynamically
                function applyProductOptions(data) {
                    if (!data) return;
                    
                    $('#input_materials').val(data.materials || '');
                    $('#input_materials_ar').val(data.materials_ar || '');
                    $('#input_sizes').val(data.sizes || '');
                    $('#input_sizes_ar').val(data.sizes_ar || '');
                    $('#input_colors').val(data.side_1_colors || '');
                    $('#input_colors_ar').val(data.side_1_colors_ar || '');
                    $('#input_sides').val(data.sides_options || '');
                    $('#input_sides_ar').val(data.sides_options_ar || '');
                    $('#input_lamination').val(data.lamination_types || '');
                    $('#input_lamination_ar').val(data.lamination_types_ar || '');
                    if (data.lamination_price !== undefined && data.lamination_price !== null) {
                        $('input[name="lamination_price"]').val(data.lamination_price);
                    }
                    $('#input_die_cutting').val(data.die_cutting_options || '');
                    $('#input_die_cutting_ar').val(data.die_cutting_options_ar || '');
                    $('#input_orientations').val(data.orientations || '');
                    $('#input_orientations_ar').val(data.orientations_ar || '');
                    $('#input_folding').val(data.folding_options || '');
                    $('#input_folding_ar').val(data.folding_options_ar || '');
                    $('#input_binding').val(data.binding_options || '');
                    $('#input_binding_ar').val(data.binding_options_ar || '');
                    if (data.quantities) {
                        $('#input_quantities').val(data.quantities);
                    }
                    if (data.allow_round_corners !== undefined) {
                        $('#allow_round_corners').prop('checked', !!data.allow_round_corners);
                    }

                    // Re-sync material prices grid with any specific rates from the loaded product
                    let $list = $('#material_prices_list');
                    let materialsStr = data.materials || '';
                    let materials = materialsStr ? materialsStr.split(',').map(s => s.trim()).filter(s => s.length > 0) : [];
                    let matPrices = data.material_prices || {};
                    $list.empty();
                    if (materials.length === 0) {
                        $list.html('<div class="col-12 text-muted small py-1" id="no_materials_notice">Enter materials above to configure individual material pricing.</div>');
                    } else {
                        materials.forEach(function(mat) {
                            let val = matPrices[mat] !== undefined ? matPrices[mat] : '';
                            let itemHtml = `
                                <div class="col-md-4 col-sm-6 mb-2 material-price-item">
                                    <label class="small text-truncate d-block mb-1 font-weight-bold" title="${mat}">${mat}</label>
                                    <div class="input-group input-group-sm">
                                        <div class="input-group-prepend"><span class="input-group-text">SAR</span></div>
                                        <input type="number" step="0.01" class="form-control" name="material_prices[${mat}]" value="${val}" placeholder="Auto rate">
                                    </div>
                                </div>
                            `;
                            $list.append(itemHtml);
                        });
                    }

                    // Show friendly notification badge
                    let pName = data.product_name || 'Database Product';
                    $('#dynamic_loaded_badge').html('<i class="fas fa-check-circle mr-1"></i> Options loaded from: <strong>' + pName + '</strong>').fadeIn();
                    setTimeout(function() {
                        $('#dynamic_loaded_badge').fadeOut();
                    }, 5000);
                }

                // 1. Click on dynamic product from database dropdown
                $(document).on('click', '.dynamic-product-select-item', function(e) {
                    e.preventDefault();
                    let productId = $(this).data('product-id');
                    let productName = $(this).data('product-name');
                    let $btn = $('#loadProductOptionsDropdownButton');
                    
                    $btn.addClass('disabled').html('<i class="fas fa-spinner fa-spin mr-1"></i> Loading...');
                    
                    $.ajax({
                        url: "{{ url('admin/products/get-options') }}/" + productId,
                        type: "GET",
                        dataType: "json",
                        success: function(response) {
                            $btn.removeClass('disabled').html('<i class="fas fa-database mr-2"></i> Copy Options from Existing Product <i class="fas fa-chevron-down ml-2 small"></i>');
                            if (response.success) {
                                applyProductOptions(response);
                                $('#loadProductOptionsDropdownButton').dropdown('toggle');
                            } else {
                                alert('Could not load options for this product.');
                            }
                        },
                        error: function() {
                            $btn.removeClass('disabled').html('<i class="fas fa-database mr-2"></i> Copy Options from Existing Product <i class="fas fa-chevron-down ml-2 small"></i>');
                            alert('Failed to connect to server.');
                        }
                    });
                });

                // 2. Filter search inside database products dropdown
                $('#search_existing_product_filter').on('input keyup', function(e) {
                    e.stopPropagation();
                    let q = $(this).val().toLowerCase().trim();
                    let matched = 0;
                    $('.dynamic-product-select-item').each(function() {
                        let text = $(this).text().toLowerCase();
                        if (!q || text.indexOf(q) !== -1) {
                            $(this).removeClass('d-none').addClass('d-flex');
                            matched++;
                        } else {
                            $(this).removeClass('d-flex').addClass('d-none');
                        }
                    });
                    if (matched === 0) {
                        $('#no_dynamic_product_matched').removeClass('d-none');
                    } else {
                        $('#no_dynamic_product_matched').addClass('d-none');
                    }
                }).on('click', function(e) {
                    e.stopPropagation();
                });

                // 3. Category / Subcategory auto-suggestion logic
                var latestCategoryOptionsCache = null;

                function checkCategoryOptions(catId, subcatId) {
                    if (!catId && !subcatId) {
                        $('#category_options_alert').addClass('d-none').removeClass('d-flex');
                        return;
                    }
                    $.ajax({
                        url: "{{ route('admin.categories.get-latest-options') }}",
                        type: "GET",
                        data: { category_id: catId, subcategory_id: subcatId },
                        dataType: "json",
                        success: function(res) {
                            if (res.success && res.materials) {
                                latestCategoryOptionsCache = res;
                                let targetName = subcatId ? $('#subcategory_id option:selected').text() : $('#category_id option:selected').text();
                                $('#category_options_alert_text').text('Existing options found for "' + targetName + '" (from ' + res.product_name + ')');
                                $('#category_options_alert').removeClass('d-none').addClass('d-flex');
                            } else {
                                latestCategoryOptionsCache = null;
                                $('#category_options_alert').addClass('d-none').removeClass('d-flex');
                            }
                        }
                    });
                }

                $('#category_id').on('change', function() {
                    let catId = $(this).val();
                    checkCategoryOptions(catId, null);
                });

                $('#subcategory_id').on('change', function() {
                    let catId = $('#category_id').val();
                    let subcatId = $(this).val();
                    checkCategoryOptions(catId, subcatId);
                });

                $('#btn_apply_category_options').on('click', function() {
                    if (latestCategoryOptionsCache) {
                        applyProductOptions(latestCategoryOptionsCache);
                        $('#category_options_alert').addClass('d-none').removeClass('d-flex');
                    }
                });

                $('#btn_dismiss_category_alert').on('click', function() {
                    $('#category_options_alert').addClass('d-none').removeClass('d-flex');
                });

                // Quick fields filter bar
                $('#quick_filter_fields').on('input keyup', function() {
                    let q = $(this).val().toLowerCase().trim();
                    if (q.length > 0) {
                        $('#clear_filter_wrapper').show();
                        let count = 0;
                        $('.option-row').each(function() {
                            let rowText = $(this).text().toLowerCase();
                            if (rowText.indexOf(q) !== -1) {
                                $(this).show();
                                count++;
                            } else {
                                $(this).hide();
                            }
                        });
                        $('#filter_stats_badge').html('<span class="text-primary font-weight-bold"><i class="fas fa-search mr-1"></i> Showing ' + count + ' matching section(s)</span>');
                    } else {
                        $('#clear_filter_wrapper').hide();
                        $('.option-row').show();
                        $('#filter_stats_badge').html('<i class="fas fa-check-circle text-success mr-1"></i> All options visible');
                    }
                });

                $('#clear_filter_fields').on('click', function() {
                    $('#quick_filter_fields').val('').trigger('input');
                });

                // Live filter for material price inputs
                $('#filter_material_price_inputs').on('input keyup', function() {
                    let q = $(this).val().toLowerCase().trim();
                    $('.material-price-item').each(function() {
                        let matName = $(this).find('label').text().toLowerCase();
                        if (!q || matName.indexOf(q) !== -1) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
