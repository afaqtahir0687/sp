@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Our Portfolio</h1>
        <a href="{{ route('admin.portfolios.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Image
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Portfolio Images</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($portfolios as $portfolio)
                        <tr>
                            <td>{{ $portfolio->id }}</td>
                            <td>
                                @if($portfolio->images && count($portfolio->images) > 0)
                                    <img src="{{ asset('storage/app/public/' . $portfolio->images[0]) }}" alt="Portfolio Image" style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-{{ $portfolio->status == 'active' ? 'success' : 'danger' }}">
                                    {{ ucfirst($portfolio->status) }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('admin.portfolios.edit', $portfolio->id) }}" class="btn btn-primary btn-sm rounded-circle"><i class="fas fa-edit"></i></a>
                                <form action="{{ route('admin.portfolios.destroy', $portfolio->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm rounded-circle" onclick="return confirm('Are you sure you want to delete this image?')"><i class="fas fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">No portfolio images uploaded yet.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
