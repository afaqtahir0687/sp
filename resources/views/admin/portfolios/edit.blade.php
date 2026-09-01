@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Edit Portfolio Image</h1>
        <a href="{{ route('admin.portfolios.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Update Image Details</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group">
                            <label class="font-weight-bold">Title (English) <span class="text-danger">*</span></label>
                            <input type="text" name="title_en" class="form-control" value="{{ $portfolio->title_en }}" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Title (Arabic) <span class="text-danger">*</span></label>
                            <input type="text" name="title_ar" class="form-control" value="{{ $portfolio->title_ar }}" required dir="rtl">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Description (English)</label>
                            <textarea name="description_en" class="form-control" rows="3">{{ $portfolio->description_en }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Description (Arabic)</label>
                            <textarea name="description_ar" class="form-control" rows="3" dir="rtl">{{ $portfolio->description_ar }}</textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Category</label>
                            <select name="category_id" class="form-control" id="categorySelect">
                                <option value="">Select Category</option>
                                @foreach(\App\Models\Category::where('status', 'active')->get() as $category)
                                    <option value="{{ $category->id }}" {{ $portfolio->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Subcategory</label>
                            <select name="subcategory_id" class="form-control" id="subcategorySelect">
                                <option value="">Select Subcategory</option>
                                @if($portfolio->category && $portfolio->category->subcategories)
                                    @foreach($portfolio->category->subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ $portfolio->subcategory_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        
                        <div class="form-group text-center">
                            <label class="font-weight-bold d-block">Current Images</label>
                            @if($portfolio->images)
                                @foreach($portfolio->images as $img)
                                    <img src="{{ asset('storage/app/public/' . $img) }}" alt="Portfolio" class="img-thumbnail m-1" style="max-height: 100px;">
                                @endforeach
                            @endif
                        </div>

                        <div class="form-group">
                            <label class="font-weight-bold">Replace Images (Select multiple, leave blank to keep current)</label>
                            <input type="file" name="images[]" class="form-control-file border p-2 rounded" accept="image/*" multiple>
                        </div>
                        
                        <div class="form-group">
                            <label class="font-weight-bold">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="active" {{ $portfolio->status == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ $portfolio->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Update Portfolio</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    $('#categorySelect').change(function () {
        var category_id = $(this).val();
        if (category_id) {
            $.ajax({
                url: "{{ route('admin.get-subcategories') }}/" + category_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    $('#subcategorySelect').empty();
                    $('#subcategorySelect').append('<option value="">Select Subcategory</option>');
                    if (data && data.length > 0) {
                        $.each(data, function (key, value) {
                            $('#subcategorySelect').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    } else {
                        $('#subcategorySelect').append('<option value="">No subcategories available</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching subcategories:', error);
                    $('#subcategorySelect').empty();
                    $('#subcategorySelect').append('<option value="">Error loading subcategories</option>');
                }
            });
        } else {
            $('#subcategorySelect').empty();
            $('#subcategorySelect').append('<option value="">Select Subcategory</option>');
        }
    });
});
</script>
@endpush
@endsection

