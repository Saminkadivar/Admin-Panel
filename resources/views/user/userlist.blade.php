
@extends('layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

</head>
<body>
    <table id="usertbl">
        <thead>
            <h1>User List</h1>
            <button class="btn btn-sm btn-primary mb-3 " onclick="window.location.href='{{ route('user.create') }}'">ADD USER</button>
            <tr>
                <th>id</th>
                <th>name</th>
                <th>email</th>
                <th>phone</th>
                <th>address<th>
                <th>action</th>
            </tr>
        </thead>
        <tbody> </tbody>
    </table>
@endsection


@section('scripts')
<script>
$(document).ready(function(){
    const table = $('#usertbl').DataTable({
        processing:true,
        serverSide:true,
        ajax: "{{ route('user.index') }}",
        columns: [
            { data:'id', name:'id'},
            { data:'name', name:'name'},
            { data:'email', name:'email'},
            { data:'phone', name:'phone'},
            { data:'address', name:'address'},
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
                        url: "{{ route('user.delete') }}/" + productId,
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
