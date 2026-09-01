@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Printing Technology</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.printing-technologies.update', $technology->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control mb-2">
                    @if($technology->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/app/public/' . $technology->image) }}" width="120" class="img-thumbnail" alt="Current Image">
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Title (English)</label>
                    <input type="text" name="title_en" value="{{ $technology->title_en }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Title (Arabic)</label>
                    <input type="text" name="title_ar" value="{{ $technology->title_ar }}" class="form-control" dir="rtl">
                </div>
                <div class="form-group">
                    <label>Description (English)</label>
                    <textarea name="description_en" class="form-control" rows="4">{{ $technology->description_en }}</textarea>
                </div>
                <div class="form-group">
                    <label>Description (Arabic)</label>
                    <textarea name="description_ar" class="form-control" dir="rtl" rows="4">{{ $technology->description_ar }}</textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $technology->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $technology->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
