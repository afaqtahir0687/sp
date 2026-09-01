@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Contact Settings</h1>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Manage Contact Information</h6>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.contact-settings.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address', $setting->address ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Phone Number</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $setting->phone ?? '') }}">
                </div>
                <div class="form-group">
                    <label>E-mail Address</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $setting->email ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Working Days/Hours</label>
                    <input type="text" name="working_hours" class="form-control" value="{{ old('working_hours', $setting->working_hours ?? '') }}">
                </div>
                <div class="form-group">
                    <label>Description Text</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $setting->description ?? '') }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Save Settings</button>
            </form>
        </div>
    </div>
</div>
@endsection

