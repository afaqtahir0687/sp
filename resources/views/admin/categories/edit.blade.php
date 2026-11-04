@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Category</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Name (English)</label>
                    <input type="text" name="name_en" class="form-control" value="{{ $category->name_en }}" required>
                </div>
                <div class="form-group">
                    <label>Name (Arabic)</label>
                    <input type="text" name="name_ar" class="form-control" value="{{ $category->name_ar }}" required dir="rtl">
                </div>

                <div class="form-group">
                    <label>Main Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($category->image)
                        <img src="{{ asset('storage/app/public/' . $category->image) }}" width="100" class="mt-2">
                    @endif
                </div>

                <div class="form-group">
                    <label>Home Page Image</label>
                    <input type="file" name="home_image" class="form-control">
                    <small class="text-muted">This image will be displayed on the homepage categories section</small>
                    @if($category->home_image)
                        <img src="{{ asset('storage/app/public/' . $category->home_image) }}" width="100" class="mt-2">
                    @endif
                </div>

                <hr>
                <h5 class="mb-3">Banner Settings</h5>

                <div class="form-group">
                    <label>Banner Image</label>
                    <input type="file" name="banner_image" class="form-control">
                    <small class="text-muted">Recommended size: 192x313px</small>
                    @if($category->banner_image)
                        <img src="{{ asset('storage/app/public/' . $category->banner_image) }}" width="100" class="mt-2">
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Top Text (English)</label>
                            <input type="text" name="banner_top_text_en" class="form-control" value="{{ $category->banner_top_text_en }}" placeholder="e.g., UP TO">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Top Text (Arabic)</label>
                            <input type="text" name="banner_top_text_ar" class="form-control" value="{{ $category->banner_top_text_ar }}" dir="rtl" placeholder="e.g., حتى">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Discount Text (English)</label>
                            <input type="text" name="banner_discount_text_en" class="form-control" value="{{ $category->banner_discount_text_en }}" placeholder="e.g., 50%">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Discount Text (Arabic)</label>
                            <input type="text" name="banner_discount_text_ar" class="form-control" value="{{ $category->banner_discount_text_ar }}" dir="rtl" placeholder="e.g., 50%">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Bottom Text (English)</label>
                            <input type="text" name="banner_bottom_text_en" class="form-control" value="{{ $category->banner_bottom_text_en }}" placeholder="e.g., OFF">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Bottom Text (Arabic)</label>
                            <input type="text" name="banner_bottom_text_ar" class="form-control" value="{{ $category->banner_bottom_text_ar }}" dir="rtl" placeholder="e.g., خصم">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Button Text (English)</label>
                            <input type="text" name="banner_button_text_en" class="form-control" value="{{ $category->banner_button_text_en }}" placeholder="e.g., SHOP NOW">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Button Text (Arabic)</label>
                            <input type="text" name="banner_button_text_ar" class="form-control" value="{{ $category->banner_button_text_ar }}" dir="rtl" placeholder="e.g., تسوق الآن">
                        </div>
                    </div>
                </div>

                                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Button Link</label>
                            <input type="text" name="banner_button_link" class="form-control" value="{{ old('banner_button_link', $category->banner_button_link) }}" placeholder="e.g., /products or https://example.com">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Text Color</label>
                            <div class="d-flex align-items-center">
                                <input type="color" name="banner_text_color" class="form-control mr-2" value="{{ old('banner_text_color', $category->banner_text_color ?? '#ffffff') }}" style="width: 60px; padding: 2px; height: 38px;">
                                <input type="text" id="banner_text_color_hex" class="form-control" placeholder="#ffffff" value="{{ old('banner_text_color', $category->banner_text_color ?? '#ffffff') }}" oninput="this.previousElementSibling.value = this.value">
                            </div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const colorInput = document.querySelector('input[type="color"][name="banner_text_color"]');
                                    const hexInput = document.getElementById('banner_text_color_hex');
                                    if(colorInput && hexInput) {
                                        colorInput.addEventListener('input', function() {
                                            hexInput.value = this.value;
                                        });
                                    }
                                });
                            </script>
                            @error('banner_text_color')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <label>Display Order (ترتیب)</label>
                    <input type="number" name="order" class="form-control" value="{{ old('order', $category->order ?? 0) }}" placeholder="e.g. 1 for 1st, 2 for 2nd">
                    <small class="text-muted">Determines the display order in menus and home page (1 shows first, 2 second, etc.).</small>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $category->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $category->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
