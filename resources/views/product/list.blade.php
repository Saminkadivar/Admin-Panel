{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

    <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
</head>
<body>
    <table class="" id="producttbl">
        <button class="btn btn-sm btn-primary" onclick='window.location.href="{{ route("product.create") }}"' >Add</button>
        <thead>
            <tr>
            @if (session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
            @endif
            <th>id</th>
            <th>product name </th>
            <th>category</th>
            <th>price</th>
            <th>stock</th>
            <th>action</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
</body>
</html>
    <script>

$(document).ready(function(){

    const table = $('#producttbl').DataTable({
        processing:true,
        serverSide:true,
        ajax: "{{ route('product.index') }}",
        columns: [
            { data:'id', name:'id'},
            { data:'p_name', name:'p_name'},
            { data:'category', name:'category'},
            { data:'price', name:'price'},
            { data:'stock', name:'stock'},
            { data:'action', name:'action', orderable:false, searchable:false},
        ]
    });

  $('body').on('click', '.deleteBtn', function() {
                const productId = $(this).data("id");
                swal({
                        title: "Are you sure?",
                        text: "You will soft delete this product.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete!",
                        cancelButtonText: "Cancel",
                    },
                    function(isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                url: "{{ route('product.delete') }}/" + productId,
                                type: "POST",
                                data: {
                                    _token: "{{ csrf_token() }}",
                                    _method: "DELETE"
                                },
                                success: function(response) {
                                    swal("success!", "Delete failed.", "success");

                                    table.ajax.reload();
                                },
                                error: function() {
                                    swal("Error!", "Delete failed.", "error");
                                }
                            });
                        }
                    });
            });
});


    </script>
 --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        img {
    object-fit: cover;
    border-radius: 4px;
    max-height: 80px;
}
</style>
</head>
<body>
    
</body>
</html>

@extends('layout')

@section('content')
<div class="container-fluid">
    <h1 class="mb-4">Products</h1>

    @if (session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <button class="btn btn-primary mb-3" onclick="window.location.href='{{ route('product.create') }}'">+ Add New Product</button>

    <table id="producttbl">
        <thead>
            <tr>
                <th>Id</th>
                <th>Product name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>product picture</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
    const table = $('#producttbl').DataTable({
        processing:true,
        serverSide:true,
        ajax: "{{ route('product.index') }}",
        columns: [
            { data:'id', name:'id'},
            { data:'p_name', name:'p_name'},
            { data:'category', name:'category'},
            { data:'price', name:'price'},
            { data:'stock', name:'stock'},
            { data:'product_picture', name:'product_picture'},
            { data:'action', name:'action', orderable:false, searchable:false},
        ]
    });

    $('body').on('click', '.deleteBtn', function() {
        const productId = $(this).data("id");
        swal({
                title: "Are you sure?",
                text: "You will soft delete this product.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "Cancel",
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ route('product.delete') }}/" + productId,
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE"
                        },
                        success: function(response) {
                            swal("Deleted!", "Product has been deleted.", "success");
                            table.ajax.reload();
                        },
                        error: function() {
                            swal("Error!", "Delete failed.", "error");
                        }
                    });
                }
            });
    });
});
</script>
@endsection

