@extends('layouts.app')

@section('content')
<div class="container">
    <a class="btn btn-primary px-4" href="{{ route('users.index')}}">Back</a>
    <h1 class="mt-4 mb-4">Tickets</h1>
    <div class="row row-cols-1 row-cols-md-2 g-4">
        @foreach($tickets as $ticket)
        <div class="col">
            <div class="card shadow">
                <div class="card-header bg-primary d-flex">
                    @if($ticket->status == 'Open')
                        <h5 class="card-title text-white p-2 mb-0 rounded" style="background-color: rgb(5, 185, 20)">{{ $ticket->status }}</h5>
                    @else
                        <h5 class="card-title text-white p-2 mb-0 bg-danger rounded">{{ $ticket->status }}</h5>
                    @endif
                </div>
                <div class="card-body">
                    <h4 class="card-title">{{ $ticket->title }}</h4>
                    <p class="card-text"><strong>Type:</strong> {{ $ticket->type }}</p>
                    <p class="card-text"><strong>Submitted by:</strong> {{ $ticket->user->name }}</p>
                    <p class="card-text"><strong>Created at:</strong> {{ $ticket->created_at }}</p>
                    <div class="mt-3 d-flex justify-content-around">
                        <a class="btn btn-outline-success btn-sm px-4" href="{{ route('tickets.edit' , $ticket)}}">Edit</a>
                        <form action="{{ route('tickets.destroy' , $ticket)}}" method="post">
                            @csrf
                            @method('delete')
                            <input type="submit" class="btn btn-outline-danger btn-sm px-3" value="Delete">
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
