@extends('admin.layouts.master')
@section('title', 'Edit SEO Setting')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit SEO Setting</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.seo-settings.update', $seoSetting->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="page_name" class="form-label">Page Name / Route Name <span class="text-danger">*</span></label>
                        <input type="text" name="page_name" id="page_name" class="form-control @error('page_name') is-invalid @enderror" value="{{ old('page_name', $seoSetting->page_name) }}" required placeholder="e.g. home, about, books.index">
                        @error('page_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="title" class="form-label">Meta Title</label>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $seoSetting->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="meta_keywords" class="form-label">Meta Keywords</label>
                        <textarea name="meta_keywords" id="meta_keywords" rows="3" class="form-control @error('meta_keywords') is-invalid @enderror">{{ old('meta_keywords', $seoSetting->meta_keywords) }}</textarea>
                        @error('meta_keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea name="meta_description" id="meta_description" rows="4" class="form-control @error('meta_description') is-invalid @enderror">{{ old('meta_description', $seoSetting->meta_description) }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Update Setting</button>
                    <a href="{{ route('admin.seo-settings.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
