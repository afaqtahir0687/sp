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

                <div class="form-group">
                    <label>Banner Button Link</label>
                    <input type="text" name="banner_button_link" class="form-control" value="{{ $category->banner_button_link }}" placeholder="e.g., /products or https://example.com">
                </div>

                <hr>

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
