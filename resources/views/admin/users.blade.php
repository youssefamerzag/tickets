@extends('layouts.app')

@section('content')

<div class="container">
    <h1 class="mt-5 mb-4">Users List</h1>

    <div class="row">
        <div class="shadow-sm">
            <div class="list-group row">
                @foreach ($users as $user)
                <div class="list-group-item list-group-item-action">
                    <div class="d-flex justify-content-between">
                        <h5 class="mb-1">{{ $user->name }}</h5>
                        <small>{{ $user->created_at->format('M d, Y') }}</small>
                    </div>
                    <p class="mb-1">{{ $user->email }}</p>
                    <div>
                        <form action="{{ route('user.destroy' , $user)}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn bg-danger text-white" value="Delete">
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
