@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Printing Technologies</h6>
            <a href="{{ route('admin.printing-technologies.create') }}" class="btn btn-primary btn-sm">Add New</a>
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
                            <th>Title (EN)</th>
                            <th>Title (AR)</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($technologies as $tech)
                            <tr>
                                <td>{{ $tech->id }}</td>
                                <td>
                                    @if($tech->image)
                                        <img src="{{ asset('storage/app/public/' . $tech->image) }}" width="60" alt="{{ $tech->title_en }}">
                                    @else
                                        No Image
                                    @endif
                                </td>
                                <td>{{ $tech->title_en }}</td>
                                <td>{{ $tech->title_ar }}</td>
                                <td>
                                    <span class="badge badge-{{ $tech->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($tech->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.printing-technologies.edit', $tech->id) }}"
                                         class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.printing-technologies.destroy', $tech->id) }}" method="POST"
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
