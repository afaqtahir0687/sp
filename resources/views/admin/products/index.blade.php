@extends('admin.layouts.master')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="m-0 font-weight-bold text-primary">Products</h6>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm">Add New</a>
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
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            @php
                                $imgSrc = $product->image ? asset('storage/' . $product->image) : asset('assets/images/placeholder.png');
                            @endphp
                            <img src="{{ $imgSrc }}" width="50" height="50" style="object-fit: cover; border-radius: 6px;" alt="{{ $product->name_en }}" onerror="this.onerror=null;this.src='{{ asset('storage/app/public/' . $product->image) }}';">
                        </td>
                        <td>
                            <strong>{{ $product->name_en }}</strong>
                            <div class="small text-muted" dir="rtl">{{ $product->name_ar }}</div>
                        </td>
                        <td>{{ $product->category ? $product->category->name_en : 'N/A' }}</td>
                        <td><strong>SAR {{ number_format((float)$product->price, 2) }}</strong></td>
                         <td>
                            <span class="badge badge-{{ $product->status == 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                        <td style="white-space: nowrap;">
                            <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-info btn-sm py-1 px-2" title="View Details & PDF">
                                <i class="fas fa-eye"></i> Details
                            </a>
                            <a href="{{ route('admin.products.pdf', $product->id) }}" target="_blank" class="btn btn-danger btn-sm py-1 px-2" title="Export PDF Document" style="background-color: #e74a3b !important; border-color: #e74a3b !important;">
                                <i class="fas fa-file-pdf"></i> PDF
                            </a>
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning btn-sm py-1 px-2" title="Edit Product">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm py-1 px-2" onclick="return confirm('Are you sure you want to delete this product?')" title="Delete Product" style="background: transparent !important; color: #e74a3b !important; border-color: #e74a3b !important;">
                                    <i class="fas fa-trash"></i>
                                </button>
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

