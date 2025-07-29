@extends('layout')

@section('content')
    <div class="container">
        <h2>All Comments</h2>
        <a href="{{ route('comments.create') }}" class="btn btn-primary mb-3">Add New Comment</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table id="comment">
            <thead>
                <tr>
                    <th>id</th>
                    <th>User_id</th>
                    <th>content</th>
                    <th>created_at</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            const table = $('#comment').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('comments.index') }}",
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'user_id',
                        name: 'user_id'
                    },
                    {
                        data: 'content',
                        name: 'content'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

  $('body').on('click', '.deleteBtn', function() {
        const deleteId = $(this).data("id");
        swal({
                title: "Are you sure?",
                text: "You will soft delete this comment.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete!",
                cancelButtonText: "Cancel",
            },
            function(isConfirm) {
                if (isConfirm) {
                    $.ajax({
                        url: "{{ route('comments.delete') }}/" + deleteId,
                        type: "POST",
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: "DELETE"
                        },
                        success: function(response) {
                            swal("Deleted!", "Comment has been deleted.", "success");
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
