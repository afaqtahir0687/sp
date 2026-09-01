@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit blankCategory</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.blank-categories.update', $blankCategory->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label>Name (English)</label>
                    <input type="text" name="name_en" class="form-control" value="{{ $blankCategory->name_en }}" required>
                </div>
                <div class="form-group">
                    <label>Name (Arabic)</label>
                    <input type="text" name="name_ar" class="form-control" value="{{ $blankCategory->name_ar }}" required dir="rtl">
                </div>

                <div class="form-group">
                    <label>Main Image</label>
                    <input type="file" name="image" class="form-control">
                    @if($blankCategory->image)
                        <img src="{{ asset('storage/app/public/' . $blankCategory->image) }}" width="100" class="mt-2">
                    @endif
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $blankCategory->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $blankCategory->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
@endsection
