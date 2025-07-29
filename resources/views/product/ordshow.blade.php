@extends('layout')

@section('content')
<h1 class="mb-4">Order #{{ $order->id }}</h1>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Customer</h5>
        <p>
            Name: {{ $order->user->name ?? 'Guest' }}<br>
            Email: {{ $order->user->email ?? 'N/A' }}
        </p>

        <h5 class="card-title">Order Details</h5>
        <p>
            Product: {{ $order->product->p_name ?? 'no found' }}<br>
            Total: ₹{{ $order->total }}<br>
           Status:
    @if ($order->status === 'pending')
        <span class="badge bg-warning text-dark">{{ ucfirst($order->status) }}</span>
    @elseif ($order->status === 'completed')
        <span class="badge bg-success">{{ ucfirst($order->status) }}</span>
    @elseif ($order->status === 'cancelled')
        <span class="badge bg-danger">{{ ucfirst($order->status) }}</span>
    @else
        <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
    @endif
    <br>

            Created at: {{ $order->created_at->format('Y-m-d H:i') }}
        </p>
    </div>
</div>

@endsection
