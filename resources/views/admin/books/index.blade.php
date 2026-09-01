@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Books</h6>
            <a href="{{ route('admin.books.create') }}" class="btn btn-primary btn-sm">Add New</a>
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
                            <th>Cover</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>
                                    @if($book->images && count($book->images) > 0)
                                        <img src="{{ asset('storage/app/public/' . $book->images[0]) }}" width="60" alt="Book Cover">
                                    @else
                                        <span class="text-muted">No image</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $book->name_en }}</strong>
                                    @if($book->name_ar)
                                        <br><small class="text-muted">{{ $book->name_ar }}</small>
                                    @endif
                                </td>
                                <td>{{ $book->author ? $book->author->name : '-' }}</td>
                                <td>{{ $book->publisher ? $book->publisher->name : '-' }}</td>
                                <td>{{ $book->bookCategory ? $book->bookCategory->name : '-' }}</td>
                                <td>{{ number_format($book->price, 2) }}</td>
                                <td>
                                    <span class="badge badge-{{ $book->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($book->status) }}
                                    </span>
                                    @if($book->is_featured)
                                        <span class="badge badge-warning">Featured</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.books.edit', $book->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST"
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
