@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Publishers</h6>
            <a href="{{ route('admin.publishers.create') }}" class="btn btn-primary btn-sm">Add New</a>
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
                            <th>Logo</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Books</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($publishers as $publisher)
                            <tr>
                                <td>{{ $publisher->id }}</td>
                                <td>
                                    @if($publisher->logo)
                                        <img src="{{ asset('storage/app/public/' . $publisher->logo) }}" width="100" alt="Publisher Logo">
                                    @else
                                        <span class="text-muted">No logo</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $publisher->name_en }}</strong>
                                    @if($publisher->name_ar)
                                        <br><small class="text-muted">{{ $publisher->name_ar }}</small>
                                    @endif
                                </td>
                                <td>{{ $publisher->slug }}</td>
                                <td>
                                    @if($publisher->books && $publisher->books->count() > 0)
                                        <span class="badge badge-info">{{ $publisher->books->count() }} Books</span>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge badge-{{ $publisher->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($publisher->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.publishers.edit', $publisher->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.publishers.destroy', $publisher->id) }}" method="POST"
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
