@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">View Inquiry</h1>
        <a href="{{ route('admin.inquiries.index') }}" class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">Back to Inquiries</a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Inquiry Details</h6>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold">From:</div>
                <div class="col-md-10">{{ $inquiry->name }}</div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold">Email:</div>
                <div class="col-md-10"><a href="mailto:{{ $inquiry->email }}">{{ $inquiry->email }}</a></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold">Phone Number:</div>
                <div class="col-md-10"><a href="tel:{{ $inquiry->number }}">{{ $inquiry->number }}</a></div>
            </div>
            <div class="row mb-3">
                <div class="col-md-2 font-weight-bold">Received:</div>
                <div class="col-md-10">{{ $inquiry->created_at->format('d M, Y H:i A') }}</div>
            </div>
            <hr>
            <div class="row mb-3">
                <div class="col-md-12 font-weight-bold mb-2">Message Content:</div>
                <div class="col-md-12 p-3 bg-light rounded">
                    {!! nl2br(e($inquiry->message)) !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
