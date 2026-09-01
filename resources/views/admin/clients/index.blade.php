@extends('admin.layouts.master')

@section('content')
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Our Clients</h6>
            <a href="{{ route('admin.clients.create') }}" class="btn btn-primary btn-sm">Add New Client</a>
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
                            <th>Logo</th>
                            <th>Name (EN)</th>
                            <th>Name (AR)</th>
                            <th>Website</th>
                            <th>Order</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clients as $client)
                            <tr>
                                <td>{{ $client->id }}</td>
                                <td>
                                    @if($client->image)
                                        <img src="{{ asset('storage/app/public/' . $client->image) }}" width="80" height="50" style="object-fit:contain;" alt="{{ $client->name_en }}">
                                    @else
                                        <span class="text-muted">No Logo</span>
                                    @endif
                                </td>
                                <td>{{ $client->name_en }}</td>
                                <td>{{ $client->name_ar }}</td>
                                <td>{{ $client->website }}</td>
                                <td>{{ $client->sort_order }}</td>
                                <td>
                                    <span class="badge badge-{{ $client->status == 'active' ? 'success' : 'danger' }}">
                                        {{ ucfirst($client->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.clients.edit', $client->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="d-inline">
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
