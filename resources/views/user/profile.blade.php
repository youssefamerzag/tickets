@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2 class="text-center">{{ $user->name }}</h2>
        </div>
        <div class="card-body">
            <h5 class="card-title">Email:</h5>
            <p class="card-text">{{ $user->email }}</p>
        </div>
    </div>

    <div class="mt-4">
        <a class="btn btn-success" href="{{ route('tickets.create') }}">Create New Ticket</a>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title">Tickets</h5>
        </div>
        <ul class="list-group list-group-flush">
            @forelse($tickets as $ticket)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center text-center">
                        @if($ticket->status == 'Open')
                            <span class="bg-primary p-2 text-white rounded">{{ $ticket->status }}</span>
                        @endif
                        @if($ticket->status != 'Open')
                            <span class="bg-danger p-2 text-white rounded">{{ $ticket->status }}</span>
                        @endif
                        <div>
                            <h6 class="mb-1">{{ $ticket->title }}</h6>
                            <p class="mb-1">Type: {{ $ticket->type }}</p>
                        </div>
                        <div>
                        <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-outline-primary px-3 m-1">Edit</a>
                        <form action="{{ route('tickets.destroy', $ticket->id)}}" method="post">
                            @csrf
                            @method('delete')
                            <input class="btn btn-sm btn-outline-danger px-2 m-1" type="submit" value="Delete">
                        </form>
                        </div>
                    </div>
                </li>
            @empty
                <li class="list-group-item">No tickets found.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
