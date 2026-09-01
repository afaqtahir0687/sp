@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Subcategory</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.subcategories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label>Parent Category <span class="text-danger">*</span></label>
                    <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                        <option value="">Select Parent Category</option>
                        @foreach($parent_categories as $parent)
                            <option value="{{ $parent->id }}" {{ old('category_id') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Select the parent category for this subcategory</small>
                </div>

                <div class="form-group">
                    <label>Subcategory Name (English) <span class="text-danger">*</span></label>
                    <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror" 
                           value="{{ old('name_en') }}" required>
                    @error('name_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Subcategory Name (Arabic) <span class="text-danger">*</span></label>
                    <input type="text" name="name_ar" class="form-control @error('name_ar') is-invalid @enderror" 
                           value="{{ old('name_ar') }}" required dir="rtl">
                    @error('name_ar')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Recommended size: 280x280 pixels</small>
                </div>

                <div class="form-group">
                    <label>Banner Image</label>
                    <input type="file" name="banner_image" class="form-control @error('banner_image') is-invalid @enderror">
                    @error('banner_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">This image will be displayed as the banner on the subcategory page</small>
                </div>

                <hr>
                <h5 class="mb-3">Banner Settings</h5>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Title (English)</label>
                            <input type="text" name="banner_title_en" class="form-control @error('banner_title_en') is-invalid @enderror" value="{{ old('banner_title_en') }}" placeholder="e.g., Letterheads Designing">
                            @error('banner_title_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Title (Arabic)</label>
                            <input type="text" name="banner_title_ar" class="form-control @error('banner_title_ar') is-invalid @enderror" value="{{ old('banner_title_ar') }}" dir="rtl" placeholder="e.g., تصميم الترويسة">
                            @error('banner_title_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Button Text (English)</label>
                            <input type="text" name="banner_button_text_en" class="form-control @error('banner_button_text_en') is-invalid @enderror" value="{{ old('banner_button_text_en') }}" placeholder="e.g., GET YOURS">
                            @error('banner_button_text_en')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Button Text (Arabic)</label>
                            <input type="text" name="banner_button_text_ar" class="form-control @error('banner_button_text_ar') is-invalid @enderror" value="{{ old('banner_button_text_ar') }}" dir="rtl" placeholder="e.g., احصل على خاصتك">
                            @error('banner_button_text_ar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Button Link</label>
                            <input type="text" name="banner_button_link" class="form-control @error('banner_button_link') is-invalid @enderror" value="{{ old('banner_button_link') }}" placeholder="e.g., #products-grid or /some-page">
                            @error('banner_button_link')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Banner Text Color</label>
                            <div class="d-flex align-items-center">
                                <input type="color" name="banner_text_color" class="form-control mr-2" value="{{ old('banner_text_color', '#000000') }}" style="width: 60px; padding: 2px; height: 38px;">
                                <input type="text" id="banner_text_color_hex" class="form-control" placeholder="#000000" value="{{ old('banner_text_color', '#000000') }}" oninput="this.previousElementSibling.value = this.value">
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
                    <label>Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create Subcategory</button>
                <a href="{{ route('admin.subcategories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
