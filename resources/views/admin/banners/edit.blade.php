@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Banner</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.banners.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($banner->image)
                        <img src="{{ asset('storage/app/public/' . $banner->image) }}" width="100" class="mt-2">
                    @endif
                </div>
                <div class="form-group">
                    <label>Banner Type</label>
                    <select name="type" class="form-control" required>
                        <option value="concept" {{ $banner->type == 'concept' ? 'selected' : '' }}>Concept Banner (From Concept to Delivery)</option>
                        <option value="big_sale" {{ $banner->type == 'big_sale' ? 'selected' : '' }}>Big Sale Banner</option>
                        <option value="promo" {{ $banner->type == 'promo' ? 'selected' : '' }}>Promo Banner</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Title (English)</label>
                    <input type="text" name="title_en" class="form-control" value="{{ $banner->title_en }}">
                </div>
                <div class="form-group">
                    <label>Title (Arabic)</label>
                    <input type="text" name="title_ar" class="form-control" value="{{ $banner->title_ar }}" dir="rtl">
                </div>
                <div class="form-group">
                    <label>Subtitle (English)</label>
                    <input type="text" name="subtitle_en" class="form-control" value="{{ $banner->subtitle_en }}">
                </div>
                <div class="form-group">
                    <label>Subtitle (Arabic)</label>
                    <input type="text" name="subtitle_ar" class="form-control" value="{{ $banner->subtitle_ar }}" dir="rtl">
                </div>
                <div class="form-group">
                    <label>Description (English)</label>
                    <textarea name="description_en" class="form-control" rows="3">{{ $banner->description_en }}</textarea>
                </div>
                <div class="form-group">
                    <label>Description (Arabic)</label>
                    <textarea name="description_ar" class="form-control" rows="3" dir="rtl">{{ $banner->description_ar }}</textarea>
                </div>
                <div class="form-group">
                    <label>Link</label>
                    <input type="text" name="link" class="form-control" value="{{ $banner->link }}">
                </div>
                <div class="form-group">
                    <label>Button Text (English)</label>
                    <input type="text" name="button_text_en" class="form-control" value="{{ $banner->button_text_en }}">
                </div>
                <div class="form-group">
                    <label>Button Text (Arabic)</label>
                    <input type="text" name="button_text_ar" class="form-control" value="{{ $banner->button_text_ar }}" dir="rtl">
                </div>
                <div class="form-group">
                    <label>Discount Amount (for Promo Banner)</label>
                    <input type="number" step="0.01" name="discount_amount" class="form-control" value="{{ $banner->discount_amount }}">
                </div>
                <div class="form-group">
                    <label>Discount Text (English/Arabic)</label>
                    <input type="text" name="discount_text" class="form-control" value="{{ $banner->discount_text }}" placeholder="e.g., OFF / فقط">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $banner->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $banner->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
