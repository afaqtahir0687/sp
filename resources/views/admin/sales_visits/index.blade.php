@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sales Visit Requests</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Incoming Sales Visit Requests</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Preferred Dates</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $visit)
                        <tr class="{{ $visit->is_read ? '' : 'font-weight-bold' }}">
                            <td>{{ $visit->id }}</td>
                            <td>{{ $visit->full_name }}</td>
                            <td>{{ $visit->email }}</td>
                            <td>{{ $visit->mobile_number }}</td>
                            <td>
                                @foreach($visit->preferred_dates as $date)
                                    <span class="badge badge-info d-block mb-1">{{ \Carbon\Carbon::parse($date)->format('d M Y, h:i A') }}</span>
                                @endforeach
                            </td>
                            <td>{{ $visit->created_at->format('d M, Y') }}</td>
                            <td>
                                @if($visit->is_read)
                                    <span class="badge badge-secondary">Read</span>
                                @else
                                    <span class="badge badge-success">New</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.sales-visits.show', $visit->id) }}" class="btn btn-sm btn-info">View</a>
                                <form action="{{ route('admin.sales-visits.destroy', $visit->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this request?');">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No sales visit requests found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $requests->links() }}
            </div>
        </div>
    </div>
</div>
@endsection

