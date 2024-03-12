@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="text-center mb-0 p-1">Admin: {{ $user->name }}</h2>
        </div>
        <div class="card-body">
            <h5 class="card-title">Email:</h5>
            <p class="card-text">{{ $user->email }}</p>
        </div>
    </div>

    <div class="mt-4 mb-3">
        <a class="btn btn-success" href="{{ route('tickets.create') }}">Create New Ticket</a>
    </div>

    <div class="row row-cols-1 row-cols-md-3 g-4">
        @forelse($tickets as $ticket)
        <div class="col">
            <div class="card">
                <div class="card-body">
                    @if($ticket->status == 'Open')
                    <span class="badge bg-primary p-2">{{ $ticket->status }}</span>
                    @else
                    <span class="badge bg-danger p-2">{{ $ticket->status }}</span>
                    @endif
                    <h5 class="card-title mt-3">{{ $ticket->title }}</h5>
                    <p class="card-text">Type: {{ $ticket->type }}</p>
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-primary btn-sm">Show</a>
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-success btn-sm mx-1">Edit</a>
                        <form action="{{ route('tickets.destroy', $ticket->id)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this ticket?')">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Are you sure you want to delete this ticket?')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <p class="card-text">No tickets found.</p>
                </div>
            </div>
        </div>
        @endforelse
    </div>
</div>
@endsection
