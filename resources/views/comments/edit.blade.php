@extends('layout')

@section('content')
<div class="container">
    <h2>Edit Comment</h2>

    <form action="{{ route('comments.update', $comment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>User</label>
            <select name="user_id" class="form-control" required>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $comment->user_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Comment</label>
            <textarea name="content" class="form-control" rows="4" required>{{ $comment->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Comment</button>
        <a href="{{ route('comments.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
