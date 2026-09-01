@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Industry</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.industries.update', $industry->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control mb-2">
                    @if($industry->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/app/public/' . $industry->image) }}" width="120" class="img-thumbnail" alt="Current Image">
                        </div>
                    @endif
                </div>
                <div class="form-group">
                    <label>Icon (Optional class name e.g., fa fa-heart)</label>
                    <input type="text" name="icon" value="{{ $industry->icon }}" class="form-control">
                </div>
                <div class="form-group">
                    <label>Title (English)</label>
                    <input type="text" name="title_en" value="{{ $industry->title_en }}" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Title (Arabic)</label>
                    <input type="text" name="title_ar" value="{{ $industry->title_ar }}" class="form-control" dir="rtl">
                </div>
                <div class="form-group">
                    <label>Description (English)</label>
                    <textarea name="description_en" class="form-control" rows="4">{{ $industry->description_en }}</textarea>
                </div>
                <div class="form-group">
                    <label>Description (Arabic)</label>
                    <textarea name="description_ar" class="form-control" dir="rtl" rows="4">{{ $industry->description_ar }}</textarea>
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $industry->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $industry->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
