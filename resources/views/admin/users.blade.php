@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="mt-2 mb-4 text-center">Users List</h1>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach ($users as $user)
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">{{ $user->name }}</h5>
                    <p class="card-text"><strong>Role:</strong> {{ $user->role }}</p>
                    <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
                    <p class="card-text"><small class="text-muted"><strong>Joined:</strong> {{ $user->created_at->diffForHumans() }}</small></p>
                </div>
                <div class="card-footer d-flex justify-content-between align-items-center">
                    <a class="btn btn-primary btn-sm" href="{{ route('user.tickets' , $user )}}">Tickets</a>
                    <form action="{{ route('user.destroy', $user) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
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
</div>

@endsection
