@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Portfolio Image</h1>
        <a href="{{ route('admin.portfolios.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Upload Image</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.portfolios.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-bold">Title (English) <span class="text-danger">*</span></label>
                            <input type="text" name="title_en" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Title (Arabic) <span class="text-danger">*</span></label>
                            <input type="text" name="title_ar" class="form-control" required dir="rtl">
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Description (English)</label>
                            <textarea name="description_en" class="form-control" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Description (Arabic)</label>
                            <textarea name="description_ar" class="form-control" rows="3" dir="rtl"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Category</label>
                            <select name="category_id" class="form-control" id="categorySelect">
                                <option value="">Select Category</option>
                                @foreach(\App\Models\Category::where('status', 'active')->get() as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Subcategory</label>
                            <select name="subcategory_id" class="form-control" id="subcategorySelect">
                                <option value="">Select Subcategory</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Images (Select multiple) <span class="text-danger">*</span></label>
                            <input type="file" name="images[]" class="form-control-file border p-2 rounded" accept="image/*" multiple required>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Status <span class="text-danger">*</span></label>
                            <select name="status" class="form-control" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Save Portfolio</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    console.log('Portfolio create page loaded');
    
    $('#categorySelect').change(function () {
        console.log('Category changed to:', $(this).val());
        var category_id = $(this).val();
        if (category_id) {
            console.log('Fetching subcategories for category:', category_id);
            $.ajax({
                url: "{{ route('admin.get-subcategories') }}/" + category_id,
                type: "GET",
                dataType: "json",
                success: function (data) {
                    console.log('Subcategories received:', data);
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
                    console.log('XHR response:', xhr.responseText);
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

