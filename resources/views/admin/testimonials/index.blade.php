@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Customer Reviews / Testimonials</h6>
            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary btn-sm">Add New Review</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Photo</th>
                            <th>Client Name (EN)</th>
                            <th>Position</th>
                            <th>Company</th>
                            <th>Rating</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($testimonials as $t)
                            <tr>
                                <td>{{ $t->id }}</td>
                                <td>
                                    @if($t->client_image)
                                        <img src="{{ asset('storage/' . $t->client_image) }}" width="50" height="50"
                                            style="object-fit:cover; border-radius:50%;" alt="{{ $t->client_name_en }}">
                                    @else
                                        <span class="text-muted">No Photo</span>
                                    @endif
                                </td>
                                <td>{{ $t->client_name_en }}</td>
                                <td>{{ $t->client_position_en }}</td>
                                <td>{{ $t->client_company }}</td>
                                <td>
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $t->rating ? 'text-warning' : 'text-muted' }}"></i>
                                    @endfor
                                </td>
                                <td>{{ $t->sort_order }}</td>
                                <td>
                                    <span class="badge badge-{{ $t->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($t->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.testimonials.edit', $t->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.testimonials.destroy', $t->id) }}" method="POST" class="d-inline">
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
