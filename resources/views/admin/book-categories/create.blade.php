@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add New Book Category</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.book-categories.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label>Name (English)</label>
                    <input type="text" name="name_en" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Name (Arabic)</label>
                    <input type="text" name="name_ar" class="form-control" dir="rtl">
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
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
                <a href="{{ route('admin.book-categories.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
