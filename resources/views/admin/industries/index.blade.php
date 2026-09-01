@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Industries We Serve</h6>
            <a href="{{ route('admin.industries.create') }}" class="btn btn-primary btn-sm">Add New</a>
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
                            <th>Image</th>
                            <th>Icon</th>
                            <th>Title (EN)</th>
                            <th>Title (AR)</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($industries as $ind)
                            <tr>
                                <td>{{ $ind->id }}</td>
                                <td>
                                    @if($ind->image)
                                        <img src="{{ asset('storage/app/public/' . $ind->image) }}" width="60" alt="{{ $ind->title_en }}">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $ind->icon }}</td>
                                <td>{{ $ind->title_en }}</td>
                                <td>{{ $ind->title_ar }}</td>
                                <td>
                                    <span class="badge badge-{{ $ind->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($ind->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.industries.edit', $ind->id) }}"
                                         class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.industries.destroy', $ind->id) }}" method="POST"
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
