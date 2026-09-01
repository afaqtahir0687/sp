@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Sales Visit Request Details</h1>
        <a href="{{ route('admin.sales-visits.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to Requests
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary">Request from {{ $visit->full_name }}</h6>
            <span class="badge badge-{{ $visit->is_read ? 'secondary' : 'success' }} p-2">
                {{ $visit->is_read ? 'Read' : 'New' }}
            </span>
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold">Full Name:</div>
                <div class="col-md-10">{{ $visit->full_name }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold">Email:</div>
                <div class="col-md-10"><a href="mailto:{{ $visit->email }}">{{ $visit->email }}</a></div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold">Mobile:</div>
                <div class="col-md-10"><a href="tel:{{ $visit->mobile_number }}">{{ $visit->mobile_number }}</a></div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold">Address:</div>
                <div class="col-md-10">{{ $visit->address }}</div>
            </div>

            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold">Received:</div>
                <div class="col-md-10">{{ $visit->created_at->format('d M, Y \a\t h:i A') }}</div>
            </div>

            <hr>

            <div class="row mb-3">
                <div class="col-md-12 font-weight-bold mb-2">Preferred Date & Time Slots:</div>
                <div class="col-md-12">
                    @foreach($visit->preferred_dates as $date)
                        <span class="badge badge-primary p-2 mr-2 mb-2" style="font-size: 13px;">
                            <i class="fas fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($date)->format('l, F j, Y \a\t g:i A') }}
                        </span>
                    @endforeach
                </div>
            </div>

            @if($visit->message)
            <hr>
            <div class="row mb-3">
                <div class="col-md-12 font-weight-bold mb-2">Message / Requirements:</div>
                <div class="col-md-12 p-3 bg-light rounded">
                    {!! nl2br(e($visit->message)) !!}
                </div>
            </div>
            @endif

            <hr>

            <div class="d-flex justify-content-end">
                <form action="{{ route('admin.sales-visits.destroy', $visit->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this request?');">
                        <i class="fas fa-trash fa-sm"></i> Delete Request
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection

