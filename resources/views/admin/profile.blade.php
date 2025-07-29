@extends('layout')

@section('content')
<div class="container py-4">
    <h3>Admin Profile Settings</h3>
    @if(Auth::check())
    <h2>Welcome, {{ Auth::user()->name }}</h2>
@else
    <h2>Welcome, Guest</h2>
@endif


    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $admin->name) }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}">
        </div>

        <div class="mb-3">
            <label>Profile Picture</label><br>
            @if ($admin->profile_picture)
                <img src="{{ asset('storage/profile_pictures/' . $admin->profile_picture) }}" width="90" class="mb-2 rounded-circle">
            @endif
            <input type="file" name="profile_picture" class="form-control">
        </div>

        <button class="btn btn-primary">Update Profile</button>
    </form>

    <h4>Change Password</h4>
    <form action="{{ route('admin.change.password') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Current Password</label>
            <input type="password" name="current_password" class="form-control">
            
             <span>@error('current_password')
                {{ $message }}
            @enderror</span>
        </div>

        <div class="mb-3">
            <label>New Password</label>
            <input type="password" name="new_password" class="form-control">
            <span>@error('new_password')
                {{ $message }}
            @enderror</span>
        </div>

        <div class="mb-3">
            <label>Confirm New Password</label>
            <input type="password" name="new_password_confirmation" class="form-control">
            <span>@error('ew_password_confirmation')
                {{ $message }}
            @enderror</span>
        </div>

        <button class="btn btn-warning">Change Password</button>
    </form>
</div>
@endsection
