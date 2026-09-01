@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Author</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.authors.update', $author->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Name (English)</label>
                    <input type="text" name="name_en" class="form-control" value="{{ $author->name_en }}" required>
                </div>
                <div class="form-group">
                    <label>Name (Arabic)</label>
                    <input type="text" name="name_ar" class="form-control" value="{{ $author->name_ar }}" dir="rtl">
                </div>

                <div class="form-group">
                    <label>Bio (English)</label>
                    <textarea name="bio_en" class="form-control" rows="3">{{ $author->bio_en }}</textarea>
                </div>
                <div class="form-group">
                    <label>Bio (Arabic)</label>
                    <textarea name="bio_ar" class="form-control" rows="3" dir="rtl">{{ $author->bio_ar }}</textarea>
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($author->image)
                        <img src="{{ asset('storage/app/public/' . $author->image) }}" width="100" class="mt-2">
                    @endif
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $author->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $author->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
