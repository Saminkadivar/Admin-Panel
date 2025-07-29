{{-- @extends('layout')

@section('content')
<h1 class="mb-4">Orders</h1>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Total</th>
            <th>Status</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
    @forelse ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->user->name ?? 'Guest' }}</td>
            <td>${{ $order->total }}</td>
            <td>
                @if($order->status == 'pending')
                    <span class="badge bg-warning text-dark">{{ $order->status }}</span>
                @elseif($order->status == 'completed')
                    <span class="badge bg-success">{{ $order->status }}</span>
                @else
                    <span class="badge bg-danger">{{ $order->status }}</span>
                @endif
            </td>
            <td>{{ $order->created_at->format('Y-m-d') }}</td>
            <td>
                <a href="{{ route('product.ordshow', $order->id) }}" class="btn btn-sm btn-primary">View</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6">No orders found.</td>
        </tr>
    @endforelse
    </tbody>
</table>

{{ $orders->links() }}
@endsection --}}

@extends('layout')

@section('content')
<h1 class="mb-4">Orders</h1>

<table id="orders-table">
    <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Product</th>
            <th>Total</th>
            <th>Status</th>
            <th>Created</th>
            <th>Action</th>
        </tr>
    </thead>
</table>
@endsection

@section('scripts')
<!-- DataTables -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(function() {
    $('#orders-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ route('product.ordin.data') }}',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'user_name', name: 'user.name' },
            { data: 'product_name', name: 'product.p_name' },
            { data: 'total', name: 'total' },
            { data: 'status_badge', name: 'status', orderable: false, searchable: false },
            { data: 'created_at', name: 'created_at' },
            { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
    });
});
</script>
@endsection
