@extends('layouts.app')

@section('content')

<div class="container">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <a class="btn btn-primary px-4" href="{{ route('admin.profile')}}">Back</a>
    <h1 class="mt-2 mb-4 text-center">Users List</h1>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($users as $user)
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3>{{ $user->name }}</h3>
                    <p class="card-text"><strong>Role:</strong> {{ $user->role }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="card-text"><small class="text-muted"><strong>Joined:</strong> {{ $user->created_at->diffForHumans() }}</small></p>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('user.tickets' , $user )}}">Tickets</a>
                    <form id="deleteForm" action="{{ route('user.destroy', $user) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmation()">Delete</button>
                    </form>
                    <div>
                        <form action="{{ route('user.update', $user)}}" method="post" class="d-inline">
                            @csrf
                            @method('put')
                            <div class="input-group">
                                <select name="user-role" class="form-select form-select-sm">
                                    <option value="user">User</option>
                                    <option value="editor">Editor</option>
                                </select>
                                <button type="submit" class="btn btn-success btn-sm">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    
    <script>
        function confirmation() {
            Swal.fire({
                title: "Are you sure to delete this user?",
                text: "You will not be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteForm').submit();
                    Swal.fire({
                    title: "Done!",
                    text: "the user has been updated!",
                    icon: "success"
                });
                }
            });
        }
    </script>
</div>

@endsection
