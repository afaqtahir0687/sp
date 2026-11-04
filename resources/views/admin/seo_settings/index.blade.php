@extends('admin.layouts.master')
@section('title', 'SEO Settings')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fas fa-search mr-1"></i> SEO Meta Management (All Pages)
                </h6>
                <a href="{{ route('admin.seo-settings.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus fa-sm text-white-50 mr-1"></i> Add Page SEO
                </a>
            </div>
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <p class="text-muted small mb-3">
                    Control meta titles, descriptions, and keywords for search engine optimization (SEO) across all website pages. You can edit existing pages or add custom paths (e.g. category slugs).
                </p>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="seoTable" width="100%" cellspacing="0">
                        <thead class="thead-light">
                            <tr>
                                <th style="width: 50px;">#</th>
                                <th style="width: 220px;">Page Name</th>
                                <th>Meta Title</th>
                                <th>Meta Description</th>
                                <th style="width: 140px;" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($seoSettings as $setting)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="font-weight-bold text-primary">{{ $setting->display_page_name }}</div>
                                        <code class="text-muted small">{{ $setting->page_name }}</code>
                                    </td>
                                    <td>
                                        <strong>{{ $setting->title ?: '—' }}</strong>
                                        @if($setting->meta_keywords)
                                            <div class="small text-muted mt-1" style="max-height: 38px; overflow: hidden;" title="{{ $setting->meta_keywords }}">
                                                <i class="fas fa-tags fa-xs text-info mr-1"></i> {{ Str::limit($setting->meta_keywords, 70) }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="small text-secondary">
                                            {{ $setting->meta_description ? Str::limit($setting->meta_description, 110) : '—' }}
                                        </span>
                                    </td>
                                    <td class="text-center align-middle">
                                        <a href="{{ route('admin.seo-settings.edit', $setting->id) }}" class="btn btn-sm btn-info mb-1" title="Edit SEO">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>
                                        @if($setting->page_name !== 'default')
                                            <form action="{{ route('admin.seo-settings.destroy', $setting->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this SEO setting?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger mb-1" title="Delete">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted">
                                        No SEO Settings found. Click "Add Page SEO" to create one.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
