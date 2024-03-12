@extends('layouts.app')

@section('content')
<div class="container">
    <div class=" mt-4">
        <div class="card  shadow-sm">
            <div class="card-header bg-primary">
                <h5 class="card-title text-white mb-0 p-1">Open Tickets</h5>
            </div>
            <div class="card-body">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    @forelse($Opentickets as $Openticket)
                    <div class="col">
                        <div class="card shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title">{{ $Openticket->title }}</h3>
                                <p class="card-text mb-1">Type: {{ $Openticket->type }}</p>
                                <p class="card-text">By: {{ $Openticket->user->name }}</p>
                                <div class="mt-3 d-flex justify-content-around">
                                    <a href="{{ route('tickets.show', $Openticket->id) }}" class="btn btn-outline-primary btn-sm px-3">Show</a>
                                    @if(Auth::check() && Auth::user()->role !== 'user')
                                    <a href="{{ route('adminticket.edit', $Openticket->id) }}" class="btn btn-outline-success btn-sm px-4">Edit</a>
                                    <form action="{{ route('adminticket.destroy' , $Openticket)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this ticket?')">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-outline-danger btn-sm px-3" onclick="return confirm('Are you sure you want to delete this ticket?')">Delete</button>
                                    </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">No open tickets found.</p>
                            </div>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="card mt-4  shadow-sm">
        <div class="card-header bg-danger">
            <h5 class="card-title text-white mb-0 p-1">Closed Tickets</h5>
        </div>
        <div class="card-body">
            <div class="row row-cols-1 row-cols-md-3 g-4">
                @forelse($Closedtickets as $Closedticket)
                <div class="col">
                    <div class="card  shadow-sm">
                        <div class="card-body">
                            <h3 class="card-title">{{ $Closedticket->title }}</h3>
                            <p class="card-text mb-1">Type: {{ $Closedticket->type }}</p>
                            <p class="card-text">By: {{ $Closedticket->user->name }}</p>
                            <div class="mt-3 d-flex justify-content-around">
                                <a href="{{ route('tickets.show', $Closedticket->id) }}" class="btn btn-outline-primary btn-sm px-3">Show</a>
                                @if(Auth::check() && Auth::user()->role !== 'user')
                                <a href="{{ route('adminticket.edit', $Closedticket->id) }}" class="btn btn-outline-success btn-sm px-4">Edit</a>
                                <form action="{{ route('adminticket.destroy' , $Closedticket)}}" method="post" onsubmit="return confirm('Are you sure you want to delete this ticket?')">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-outline-danger btn-sm px-3" onclick="return confirm('Are you sure you want to delete this ticket?')">Delete</button>
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-text">No closed tickets found.</p>
                        </div>
                    </div>
                </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
