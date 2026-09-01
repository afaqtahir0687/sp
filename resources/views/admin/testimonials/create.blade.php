@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Add New Testimonial / Review</h6>
            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary btn-sm">Back</a>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Client Name (EN) <span class="text-danger">*</span></label>
                            <input type="text" name="client_name_en" class="form-control @error('client_name_en') is-invalid @enderror"
                                value="{{ old('client_name_en') }}" required>
                            @error('client_name_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Client Name (AR)</label>
                            <input type="text" name="client_name_ar" class="form-control" value="{{ old('client_name_ar') }}" dir="rtl">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Position / Title (EN)</label>
                            <input type="text" name="client_position_en" class="form-control" value="{{ old('client_position_en') }}" placeholder="e.g. CEO, Marketing Manager">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Position / Title (AR)</label>
                            <input type="text" name="client_position_ar" class="form-control" value="{{ old('client_position_ar') }}" dir="rtl">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Company</label>
                            <input type="text" name="client_company" class="form-control" value="{{ old('client_company') }}">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Review / Testimonial (EN) <span class="text-danger">*</span></label>
                    <textarea name="review_en" class="form-control @error('review_en') is-invalid @enderror" rows="4" required>{{ old('review_en') }}</textarea>
                    @error('review_en')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group">
                    <label>Review / Testimonial (AR)</label>
                    <textarea name="review_ar" class="form-control" rows="4" dir="rtl">{{ old('review_ar') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Rating <span class="text-danger">*</span></label>
                            <select name="rating" class="form-control @error('rating') is-invalid @enderror">
                                @for($i = 5; $i >= 1; $i--)
                                    <option value="{{ $i }}" {{ old('rating', 5) == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                                @endfor
                            </select>
                            @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 0) }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control @error('status') is-invalid @enderror">
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Client Photo</label>
                            <input type="file" name="client_image" class="form-control-file @error('client_image') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Max 2MB.</small>
                            @error('client_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Save Testimonial</button>
            </form>
        </div>
    </div>
@endsection
