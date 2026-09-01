@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Subcategories</h6>
            <a href="{{ route('admin.subcategories.create') }}" class="btn btn-primary btn-sm">Add New Subcategory</a>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Subcategory Name</th>
                            <th>Parent Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subcategories as $subcategory)
                            <tr>
                                <td>{{ $subcategory->id }}</td>
                                <td>
                                    @if($subcategory->image)
                                        <img src="{{ asset('storage/app/public/' . $subcategory->image) }}" width="100" alt="Subcategory Image">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $subcategory->name_en }}</td>
                                <td>
                                    @if($subcategory->category)
                                        <a href="{{ route('admin.categories.edit', $subcategory->category->id) }}" class="text-primary">
                                            {{ $subcategory->category->name_en }}
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $subcategory->slug }}</td>
                                <td>
                                    <span class="badge badge-{{ $subcategory->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($subcategory->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.subcategories.edit', $subcategory->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.subcategories.destroy', $subcategory->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this subcategory?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No subcategories found. <a href="{{ route('admin.subcategories.create') }}">Create one now</a></td>
                            </tr>
                        @endforelse
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

