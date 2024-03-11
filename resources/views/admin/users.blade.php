@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="mt-5 mb-4">Users List</h1>

    <div class="row">
        <div class="">
            <div class="shadow-sm">
                <div class="list-group row">
                    @foreach ($users as $user)
                    <div class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">{{ $user->name }}</h4>
                            <h6 class="mb-1">{{ $user->role }}</h6>
                            <small>{{ $user->created_at->format('M d, Y') }}</small>
                            <p class="mb-1">{{ $user->email }}</p>
                        </div>
                        <div class="ml-auto">
                            <div>
                                <form action="{{ route('user.destroy', $user) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <input type="submit" class="btn bg-danger text-white" value="Delete">
                                </form>
                            </div>
                            <div class="mt-2">
                                <form action="{{ route('user.update', $user)}}" method="post" class="d-flex align-items-center">
                                    @csrf
                                    @method('put')
                                    <div class="mr-2">
                                        <select name="user-role" class="form-select">
                                            <option value="user" @if($user->role === 'user') selected @endif>User</option>
                                            <option value="editor" @if($user->role === 'editor') selected @endif>Editor</option>
                                        </select>
                                    </div>
                                    <div class="mr-2">
                                        <input type="submit" class="btn bg-success text-white mx-3" value="Edit">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
