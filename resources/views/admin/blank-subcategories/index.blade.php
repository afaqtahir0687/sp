@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">blankSubcategories</h6>
            <a href="{{ route('admin.blank-subcategories.create') }}" class="btn btn-primary btn-sm">Add New Blank Subcategory</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Blank Subcategory Name</th>
                            <th>Parent Category</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($subcategories as $blankSubcategory)
                            <tr>
                                <td>{{ $blankSubcategory->id }}</td>
                                <td>
                                    @if($blankSubcategory->image)
                                        <img src="{{ asset('storage/app/public/' . $blankSubcategory->image) }}" width="100" alt="blankSubcategory Image">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $blankSubcategory->name_en }}</td>
                                <td>
                                    @if($blankSubcategory->blankCategory)
                                        <a href="{{ route('admin.blank-categories.edit', $blankSubcategory->blankCategory->id) }}" class="text-primary">
                                            {{ $blankSubcategory->blankCategory->name_en }}
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>
                                <td>{{ $blankSubcategory->slug }}</td>
                                <td>
                                    <span class="badge badge-{{ $blankSubcategory->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($blankSubcategory->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.blank-subcategories.edit', $blankSubcategory->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.blank-subcategories.destroy', $blankSubcategory->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this Blank Subcategory?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">No blankSubcategories found. <a href="{{ route('admin.blank-subcategories.create') }}">Create one now</a></td>
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

