@extends('admin.layouts.master')
@section('title', 'Edit SEO Setting')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-edit mr-1"></i> Edit SEO Setting: {{ $seoSetting->display_page_name }}
                </h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.seo-settings.update', $seoSetting->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="form-group">
                        <label for="page_name" class="font-weight-bold">Page Route Name / URL Slug <span class="text-danger">*</span></label>
                        <input type="text" name="page_name" id="page_name" class="form-control @error('page_name') is-invalid @enderror" value="{{ old('page_name', $seoSetting->page_name) }}" required {{ $seoSetting->page_name === 'default' ? 'readonly' : '' }}>
                        @error('page_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Route identifier (e.g. <code>home</code>, <code>contact.index</code>) or URL path (e.g. <code>business-stationery</code>).</small>
                    </div>

                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label for="title" class="font-weight-bold">Meta Title</label>
                            <small class="text-muted"><span id="title_count">0</span> / 60 characters</small>
                        </div>
                        <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $seoSetting->title) }}" placeholder="e.g. Best Printing & Advertising Agency | New Sign">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Recommended length: 50-60 characters for optimal Google search appearance.</small>
                    </div>

                    <div class="form-group">
                        <label for="meta_keywords" class="font-weight-bold">Meta Keywords</label>
                        <textarea name="meta_keywords" id="meta_keywords" rows="3" class="form-control @error('meta_keywords') is-invalid @enderror" placeholder="e.g. printing, business cards, flyers, banners, riyadh">{{ old('meta_keywords', $seoSetting->meta_keywords) }}</textarea>
                        @error('meta_keywords')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Separate multiple keywords with commas.</small>
                    </div>

                    <div class="form-group">
                        <div class="d-flex justify-content-between">
                            <label for="meta_description" class="font-weight-bold">Meta Description</label>
                            <small class="text-muted"><span id="desc_count">0</span> / 160 characters</small>
                        </div>
                        <textarea name="meta_description" id="meta_description" rows="4" class="form-control @error('meta_description') is-invalid @enderror" placeholder="Enter a compelling summary of the page for search results...">{{ old('meta_description', $seoSetting->meta_description) }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-muted">Recommended length: 140-160 characters.</small>
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save mr-1"></i> Update SEO Setting
                    </button>
                    <a href="{{ route('admin.seo-settings.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-success">
                    <i class="fab fa-google mr-1"></i> Google Search Preview
                </h6>
            </div>
            <div class="card-body" style="background-color: #ffffff; border-radius: 0 0 0.35rem 0.35rem;">
                <div style="font-family: Arial, sans-serif; font-size: 14px; line-height: 1.4;">
                    <div style="color: #202124; font-size: 13px; margin-bottom: 3px; word-break: break-all;">
                        <span style="color: #5f6368;">{{ url('/') }}/</span><span id="preview_slug" style="color: #202124;">{{ $seoSetting->page_name }}</span>
                    </div>
                    <div id="preview_title" style="color: #1a0dab; font-size: 18px; font-weight: 400; line-height: 1.3; cursor: pointer; text-decoration: none; margin-bottom: 4px;">
                        {{ $seoSetting->title ?: 'Page Title Appears Here' }}
                    </div>
                    <div id="preview_desc" style="color: #4d5156; font-size: 13px; line-height: 1.5;">
                        {{ $seoSetting->meta_description ?: 'Your page meta description will appear here in search engine results.' }}
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow mb-4 border-left-info">
            <div class="card-body">
                <h6 class="font-weight-bold text-info"><i class="fas fa-info-circle mr-1"></i> SEO Best Practices</h6>
                <ul class="small text-muted pl-3 mb-0">
                    <li>Include your primary keyword in the <strong>Meta Title</strong>.</li>
                    <li>Keep the title between <strong>50 to 60 characters</strong>.</li>
                    <li>Write a descriptive summary between <strong>140 to 160 characters</strong>.</li>
                    <li>For category or product pages, use the exact URL slug (e.g. <code>business-stationery</code>).</li>
                </ul>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const pageNameInput = document.getElementById('page_name');
    const titleInput = document.getElementById('title');
    const descInput = document.getElementById('meta_description');
    const previewSlug = document.getElementById('preview_slug');
    const previewTitle = document.getElementById('preview_title');
    const previewDesc = document.getElementById('preview_desc');
    const titleCount = document.getElementById('title_count');
    const descCount = document.getElementById('desc_count');

    function updatePreview() {
        const titleVal = titleInput.value.trim();
        const descVal = descInput.value.trim();
        const slugVal = pageNameInput.value.trim();

        previewTitle.innerText = titleVal ? titleVal : 'Page Title Appears Here';
        previewDesc.innerText = descVal ? descVal : 'Your page meta description will appear here in search engine results.';
        previewSlug.innerText = slugVal ? slugVal : 'page';

        titleCount.innerText = titleVal.length;
        descCount.innerText = descVal.length;

        titleCount.className = titleVal.length > 60 ? 'text-danger font-weight-bold' : 'text-muted';
        descCount.className = descVal.length > 160 ? 'text-danger font-weight-bold' : 'text-muted';
    }

    titleInput.addEventListener('input', updatePreview);
    descInput.addEventListener('input', updatePreview);
    pageNameInput.addEventListener('input', updatePreview);

    updatePreview();
});
</script>
@endsection
