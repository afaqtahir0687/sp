@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Blank Subcategory</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.blank-subcategories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                    <label>Parent Category <span class="text-danger">*</span></label>
                    <select name="blank_category_id" class="form-control @error('blank_category_id') is-invalid @enderror" required>
                        <option value="">Select Parent Category</option>
                        @foreach($parent_categories as $parent)
                            <option value="{{ $parent->id }}" {{ old('blank_category_id') == $parent->id ? 'selected' : '' }}>
                                {{ $parent->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('blank_category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <small class="form-text text-muted">Select the parent category for this Blank Subcategory</small>
                </div>

                <div class="form-group">
                    <label>Blank Subcategory Name (English) <span class="text-danger">*</span></label>
                    <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror" 
                           value="{{ old('name_en') }}" required>
                    @error('name_en')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Blank Subcategory Name (Arabic) <span class="text-danger">*</span></label>
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
                    <label>Status <span class="text-danger">*</span></label>
                    <select name="status" class="form-control @error('status') is-invalid @enderror" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Create Blank Subcategory</button>
                <a href="{{ route('admin.blank-subcategories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection

