@extends('layout')

@section('content')
<h1 class="mb-4">comment #{{ $comment->id }}</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">User</h5>
        <p>
            Name: {{ $comment->user->name ?? 'Guest' }}<br>
            Email: {{ $comment->user->email ?? 'N/A' }}
        </p>

        <h5 class="card-title">comment Details</h5>
        <p>
            content: {{ $comment->content }}<br>
            Created at: {{ $comment->created_at->format('Y-m-d H:i') }}
        </p>
    </div>
</div>

@endsection
