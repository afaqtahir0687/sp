@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.blank-products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- General Information -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle mr-1"></i> General Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="font-weight-bold">Product Name (English) <span class="text-danger">*</span></label>
                                    <input type="text" name="name_en" class="form-control" placeholder="Enter product name" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="font-weight-bold">Product Name (Arabic) <span class="text-danger">*</span></label>
                                    <input type="text" name="name_ar" class="form-control" placeholder="Enter product name in Arabic" required dir="rtl">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">SKU</label>
                                    <input type="text" name="sku" class="form-control" placeholder="SKU code">
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Category</label>
                                    <select name="blank_category_id" id="blank_category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Subcategory</label>
                                    <select name="blank_subcategory_id" id="blank_subcategory_id" class="form-control">
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
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-align-left mr-1"></i> Content & Descriptions</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Short Description (English)</label>
                            <textarea name="short_description_en" class="form-control" rows="2" placeholder="Brief overview of the product"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Short Description (Arabic)</label>
                            <textarea name="short_description_ar" class="form-control" rows="2" placeholder="Brief overview of the product in Arabic" dir="rtl"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Full Description (English)</label>
                            <textarea name="description_en" class="form-control" rows="5" placeholder="Detailed product specifications"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Full Description (Arabic)</label>
                            <textarea name="description_ar" class="form-control" rows="5" placeholder="Detailed product specifications in Arabic" dir="rtl"></textarea>
                        </div>
                    </div>
                </div>

                <!-- Size & Color Options -->
                    <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-tags mr-1"></i> Size & Color Options</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Sizes</label>
                                    <input type="text" name="sizes" class="form-control" id="sizesInput" placeholder="e.g. S, M, L, XL, XXL">
                                    <small class="text-muted">Enter sizes separated by commas</small>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="font-weight-bold">Colors</label>
                                    <input type="text" name="colors" class="form-control" placeholder="e.g. White, Black, Red, Blue">
                                    <small class="text-muted">Enter colors separated by commas</small>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-info py-2 mt-2 mb-0" role="alert">
                            <i class="fas fa-info-circle mr-1"></i>
                            <small>All sizes share the same product price. Size selection is for customer choice only.</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Pricing & Stock -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-money-bill-wave mr-1"></i> Pricing & Stock</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Base Price <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Discount Price</label>
                            <input type="number" step="0.01" name="discount_price" class="form-control">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Stock Quantity</label>
                            <input type="number" name="stock" class="form-control" value="0">
                        </div>
                    </div>
                </div>

                <!-- Media & Settings -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cog mr-1"></i> Media & Visibility</h6>
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
                                <label class="custom-control-label font-weight-bold" for="is_featured">Featured Product</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_new_arrival" name="is_new_arrival">
                                <label class="custom-control-label font-weight-bold" for="is_new_arrival">New Arrival</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Status</label>
                            <select name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg mt-4"><i class="fas fa-save mr-1"></i> Create Blank Product</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Tag-like preview for sizes
    $('#sizesInput').on('input', function() {
        const sizes = $(this).val().split(',').map(s => s.trim()).filter(s => s);
        let preview = '';
        sizes.forEach(function(size) {
            preview += `<span class="badge badge-secondary mr-1 mb-1">${size}</span>`;
        });
        $('#sizesPreview').html(preview);
    });

    // Fetch subcategories
    $('#blank_category_id').on('change', function() {
        var categoryId = $(this).val();
        var subcategorySelect = $('#blank_subcategory_id');
        subcategorySelect.empty().append('<option value="">Select Subcategory</option>');
        if (categoryId) {
            $.ajax({
                url: '/admin/get-blank-subcategories/' + categoryId,
                type: 'GET',
                success: function(data) {
                    $.each(data, function(key, value) {
                        subcategorySelect.append('<option value="' + value.id + '">' + (value.name_en ? value.name_en : value.name) + '</option>');
                    });
                }
            });
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

