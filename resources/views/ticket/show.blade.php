@extends('layouts.app')

@section('content')
<div class="container">
    @if(Auth::user()->role == 'admin')
        <a class="btn btn-primary px-4 mb-3" href="{{ route('home')}}">Back</a>
    @endif
    <div class="card bg-light">
        <div class="card-header bg-primary text-white d-flex justify-content-between">
            <h4 class="mb-0 p-1">{{ $ticket->title }}</h4>
            @if($ticket->status == 'Open')
                <h4 class="mb-0 p-1 rounded" style="background-color: rgb(5, 185, 20)">{{ $ticket->status }}</h4>
            @else
                <h4 class="mb-0 p-1 bg-danger rounded">{{ $ticket->status }}</h4>
            @endif
        </div>
        <div class="card-body">
            <p class="card-text"><strong>Description:</strong> {{ $ticket->description }}</p>
            <p class="card-text"><strong>Type:</strong> {{ $ticket->type }}</p>
            <p class="card-text"><strong>Submitted by:</strong> {{ $ticket->user->name }}</p>
            @if($ticket->file)
                <p class="card-text">
                    <strong>Attachment:</strong>
                    <a href="{{ asset('files/' . $ticket->file) }}" class="btn btn-outline-primary btn-sm" download>Download File</a>
                </p>
            @endif
        </div>
        <div class="card-footer bg-secondary text-white">
            <small>Submitted on: {{ $ticket->created_at->format('M d, Y \a\t h:i A') }}</small>
        </div>
    </div>
</div>
@endsection
