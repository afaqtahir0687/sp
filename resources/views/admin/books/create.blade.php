@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <form action="{{ route('admin.books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- General Information -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-info-circle mr-1"></i> General Information</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label class="font-weight-bold">Book Title (English) <span class="text-danger">*</span></label>
                                    <input type="text" name="name_en" class="form-control" placeholder="Enter book title" required>
                                </div>
                                <div class="form-group mt-3">
                                    <label class="font-weight-bold">Book Title (Arabic)</label>
                                    <input type="text" name="name_ar" class="form-control" placeholder="Enter book title in Arabic" dir="rtl">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">SKU <span class="text-danger">*</span></label>
                                    <input type="text" name="sku" class="form-control" placeholder="SKU code" required>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">Category</label>
                                    <select name="book_category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">Author</label>
                                    <select name="author_id" class="form-control">
                                        <option value="">Select Author</option>
                                        @foreach($authors as $author)
                                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="font-weight-bold">Publisher</label>
                                    <select name="publisher_id" class="form-control">
                                        <option value="">Select Publisher</option>
                                        @foreach($publishers as $publisher)
                                            <option value="{{ $publisher->id }}">{{ $publisher->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Book Details -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-book mr-1"></i> Book Details</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">Pages</label>
                                    <input type="number" name="pages" class="form-control" placeholder="Number of pages">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">Language</label>
                                    <input type="text" name="language" class="form-control" placeholder="e.g. English">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">Published Year</label>
                                    <input type="number" name="published_year" class="form-control" placeholder="e.g. 2024">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label class="font-weight-bold">ISBN</label>
                                    <input type="text" name="isbn" class="form-control" placeholder="ISBN number">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Descriptions -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-align-left mr-1"></i> Content & Descriptions</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Description (English)</label>
                            <textarea name="description_en" class="form-control" rows="5" placeholder="Detailed book description"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Description (Arabic)</label>
                            <textarea name="description_ar" class="form-control" rows="5" placeholder="Detailed book description in Arabic" dir="rtl"></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <!-- Pricing -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-money-bill-wave mr-1"></i> Pricing</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Price <span class="text-danger">*</span></label>
                            <input type="number" step="0.01" name="price" class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- Media & Settings -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-cog mr-1"></i> Media & Visibility</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="font-weight-bold">Book Images</label>
                            <input type="file" name="images[]" class="form-control-file border p-1 rounded w-100" multiple>
                            <small class="text-muted">Upload multiple images (cover, back, pages preview, etc.)</small>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="is_featured" name="is_featured">
                                <label class="custom-control-label font-weight-bold" for="is_featured">Featured Book</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="font-weight-bold">Status</label>
                            <select name="status" class="form-control">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-lg mt-4"><i class="fas fa-save mr-1"></i> Create Book</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
