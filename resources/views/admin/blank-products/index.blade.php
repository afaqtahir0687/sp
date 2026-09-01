@extends('admin.layouts.master')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Blank Products</h6>
        <a href="{{ route('admin.blank-products.create') }}" class="btn btn-primary btn-sm">Add New</a>
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
                        <th>Name</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blankProducts as $blankProduct)
                    <tr>
                        <td>{{ $blankProduct->id }}</td>
                        <td><img src="{{ asset('storage/app/public/' . $blankProduct->image) }}" width="50" alt="Blank Product Image"></td>
                        <td>{{ $blankProduct->name }}</td>
                        <td>{{ $blankProduct->price }}</td>
                        <td>{{ $blankProduct->stock }}</td>
                         <td>
                            <span class="badge badge-{{ $blankProduct->status == 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($blankProduct->status) }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.blank-products.edit', $blankProduct->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.blank-products.destroy', $blankProduct->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush

