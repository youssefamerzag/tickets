@extends('layouts.app')

@section('content')
<div class="container">
            <a class="btn btn-primary px-4 mb-3" href="{{ route('home')}}">Back</a>
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Ticket</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('adminticket.update', $ticket) }}" method="post">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="ticket-title">Title:</label>
                    <input type="text" class="form-control @error('ticket-title') is-invalid @enderror" id="ticket-title" name="ticket-title" value="{{ $ticket->title }}">
                    @error('ticket-title')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ticket-description">Description:</label>
                    <textarea class="form-control @error('ticket-description') is-invalid @enderror" id="ticket-description" name="ticket-description" rows="4">{{ $ticket->description }}</textarea>
                    @error('ticket-description')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ticket-type">Type:</label>
                    <select class="form-control @error('ticket-type') is-invalid @enderror" id="ticket-type" name="ticket-type">
                        <option value="Bug" {{ $ticket->type === 'Bug' ? 'selected' : '' }}>Bug</option>
                        <option value="Tach" {{ $ticket->type === 'Tach' ? 'selected' : '' }}>Tach</option>
                        <option value="Epic" {{ $ticket->type === 'Epic' ? 'selected' : '' }}>Epic</option>
                    </select>
                    @error('ticket-type')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div><div class="form-group">
                    <label for="ticket-status">status:</label>
                    <select class="form-control @error('ticket-status') is-invalid @enderror" id="ticket-status" name="ticket-status">
                        <option value="Open" {{ $ticket->type === 'Open' ? 'selected' : '' }}>Open</option>
                        <option value="Closed" {{ $ticket->type === 'Closed' ? 'selected' : '' }}>Closed</option>
                    </select>
                    @error('ticket-status')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success mt-3">Update Ticket</button>
            </form>
        </div>
    </div>
</div>
@endsection
