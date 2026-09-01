@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Popup Inquiries</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Incoming Inquiries</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone Number</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($inquiries as $inq)
                        <tr>
                            <td>{{ $inq->name }}</td>
                            <td>{{ $inq->email }}</td>
                            <td>{{ $inq->number }}</td>
                            <td>{{ $inq->created_at->format('d M, Y') }}</td>
                            <td>
                                @if($inq->is_read)
                                    <span class="badge badge-secondary">Read</span>
                                @else
                                    <span class="badge badge-success">New</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.inquiries.show', $inq->id) }}" class="btn btn-sm btn-info">View</a>
                                <form action="{{ route('admin.inquiries.destroy', $inq->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this inquiry?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No inquiries found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $inquiries->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
