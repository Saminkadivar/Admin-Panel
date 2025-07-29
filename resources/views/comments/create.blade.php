@extends('layout')

@section('content')
<div class="container">
    <h2>Add New Comment</h2>

    <form action="{{ route('comments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control" required>
                <option value="">Select user</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Comment</label>
            <textarea name="content" class="form-control" rows="4" required>{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Save Comment</button>
        <a href="{{ route('comments.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
