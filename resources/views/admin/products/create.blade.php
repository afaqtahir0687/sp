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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-tags mr-1"></i> Customization
                                Options (Comma separated)</h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Materials (English)</label>
                                        <input type="text" name="materials" class="form-control"
                                            placeholder="e.g. Matt, Gloss">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Materials (Arabic)</label>
                                        <input type="text" name="materials_ar" class="form-control"
                                            placeholder="e.g. مات, لامع" dir="rtl">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Sizes (English)</label>
                                        <input type="text" name="sizes" class="form-control" placeholder="e.g. B-Cards, A4">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Sizes (Arabic)</label>
                                        <input type="text" name="sizes_ar" class="form-control" placeholder="e.g. بطاقات, A4" dir="rtl">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Side 1 Colors (English)</label>
                                        <input type="text" name="side_1_colors" class="form-control"
                                            placeholder="e.g. CMYK">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Side 1 Colors (Arabic)</label>
                                        <input type="text" name="side_1_colors_ar" class="form-control"
                                            placeholder="e.g. CMYK" dir="rtl">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Sides Options (English)</label>
                                        <input type="text" name="sides_options" class="form-control"
                                            placeholder="e.g. 1, 2">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Sides Options (Arabic)</label>
                                        <input type="text" name="sides_options_ar" class="form-control"
                                            placeholder="e.g. 1, 2" dir="rtl">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Lamination Types (English)</label>
                                        <input type="text" name="lamination_types" class="form-control"
                                            placeholder="e.g. Matte Lamination">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Lamination Types (Arabic)</label>
                                        <input type="text" name="lamination_types_ar" class="form-control"
                                            placeholder="e.g. لمعان مات" dir="rtl">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Die Cutting (English)</label>
                                        <input type="text" name="die_cutting_options" class="form-control"
                                            placeholder="e.g. Custom, Ready">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Die Cutting (Arabic)</label>
                                        <input type="text" name="die_cutting_options_ar" class="form-control"
                                            placeholder="e.g. مخصص, جاهز" dir="rtl">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="font-weight-bold">Allowed Quantities (Comma separated)</label>
                                        <input type="text" name="quantities" class="form-control"
                                            placeholder="e.g. 100, 250, 500, 1000">
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
            });
        </script>
    @endpush
@endsection
