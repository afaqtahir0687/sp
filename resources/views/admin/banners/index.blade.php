@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Banners</h6>
            <a href="{{ route('admin.banners.create') }}" class="btn btn-primary btn-sm">Add New</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Type</th>
                            <th>Title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $banner)
                            <tr>
                                <td>{{ $banner->id }}</td>
                                <td><img src="{{ asset('storage/app/public/' . $banner->image) }}" width="100" alt="Banner Image"></td>
                                <td>
                                    <span class="badge badge-info">
                                        @if($banner->type == 'concept')
                                            Concept
                                        @elseif($banner->type == 'big_sale')
                                            Big Sale
                                        @elseif($banner->type == 'promo')
                                            Promo
                                        @else
                                            {{ ucfirst($banner->type) }}
                                        @endif
                                    </span>
                                </td>
                                <td>{{ $banner->title_en }}</td>
                                <td>
                                    <span class="badge badge-{{ $banner->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($banner->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.banners.edit', $banner->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.banners.destroy', $banner->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
