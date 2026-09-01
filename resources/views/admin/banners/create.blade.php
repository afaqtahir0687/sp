@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Banner</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Banner Type</label>
                    <select name="type" class="form-control" required>
                        <option value="concept">Concept Banner (From Concept to Delivery)</option>
                        <option value="big_sale">Big Sale Banner</option>
                        <option value="promo">Promo Banner</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Title (English)</label>
                    <input type="text" name="title_en" class="form-control">
                </div>
                <div class="form-group">
                    <label>Title (Arabic)</label>
                    <input type="text" name="title_ar" class="form-control" dir="rtl">
                </div>
                <div class="form-group">
                    <label>Subtitle (English)</label>
                    <input type="text" name="subtitle_en" class="form-control">
                </div>
                <div class="form-group">
                    <label>Subtitle (Arabic)</label>
                    <input type="text" name="subtitle_ar" class="form-control" dir="rtl">
                </div>
                <div class="form-group">
                    <label>Description (English)</label>
                    <textarea name="description_en" class="form-control" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label>Description (Arabic)</label>
                    <textarea name="description_ar" class="form-control" rows="3" dir="rtl"></textarea>
                </div>
                <div class="form-group">
                    <label>Link</label>
                    <input type="text" name="link" class="form-control">
                </div>
                <div class="form-group">
                    <label>Button Text (English)</label>
                    <input type="text" name="button_text_en" class="form-control">
                </div>
                <div class="form-group">
                    <label>Button Text (Arabic)</label>
                    <input type="text" name="button_text_ar" class="form-control" dir="rtl">
                </div>
                <div class="form-group">
                    <label>Discount Amount (for Promo Banner)</label>
                    <input type="number" step="0.01" name="discount_amount" class="form-control">
                </div>
                <div class="form-group">
                    <label>Discount Text (English/Arabic)</label>
                    <input type="text" name="discount_text" class="form-control" placeholder="e.g., OFF / فقط">
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
