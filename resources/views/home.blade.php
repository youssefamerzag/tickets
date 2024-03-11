@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title">Tickets</h5>
        </div>
        <ul class="list-group list-group-flush">
            @forelse($Opentickets as $Openticket)
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center text-center">
                        @if($Openticket->user != null)
                            @if($Openticket->status == 'Open')
                                <span class="bg-primary p-2 text-white rounded">{{ $Openticket->status }}</span>
                            @endif
                            @if($Openticket->status != 'Open')
                                <span class="bg-danger p-2 text-white rounded">{{ $Openticket->status }}</span>
                            @endif
                            <div>
                                <h5 class="mb-1 m-2">{{ $Openticket->title }}</h5>
                                <p class="mb-1">Type: {{ $Openticket->type }}</p>
                                <p class="mb-1">by: {{ $Openticket->user->name }}</p>
                            </div>
                            @if(Auth::guest() || Auth::user()->role != 'admin')
                                <a></a>
                            @endif
                            @if(Auth::check())
                                @if(Auth::user()->role === 'admin')
                                    <div>
                                        <a href="{{ route('adminticket.edit', $Openticket->id) }}" class="btn btn-sm btn-outline-primary px-3 m-1">Edit</a>
                                        <form  action="{{ route('adminticket.destroy' , $Openticket)}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <input class="btn btn-sm btn-outline-danger px-2 m-1" type="submit" value="Delete">
                                        </form>
                                    </div>
                                @endif
                            @endif
                            @else 
                            <li class="list-group-item">No tickets found.</li>
                        @endif
                    </div>
                </li>
            @empty
                <li class="list-group-item">No tickets found.</li>
            @endforelse
        </ul>
    </div>



    <div class="card mt-4">
        <div class="card-header">
            <h5 class="card-title">Closed Tickets</h5>
        </div>
        <ul class="list-group list-group-flush">
            @forelse($Closedtickets as $Closedticket)
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center text-center">
                            @if($Closedticket->user != null)
                                @if($Closedticket->status == 'Open')
                                    <span class="bg-primary p-2 text-white rounded">{{ $Closedticket->status }}</span>
                                @endif
                                @if($Closedticket->status != 'Open')
                                    <span class="bg-danger p-2 text-white rounded">{{ $Closedticket->status }}</span>
                                @endif
                                <div>
                                    <h5 class="mb-1 m-2">{{ $Closedticket->title }}</h5>
                                    <p class="mb-1">Type: {{ $Closedticket->type }}</p>
                                    <p class="mb-1">by: {{ $Closedticket->user->name }}</p>
                                </div>
                                @if(Auth::guest() || Auth::user()->role != 'admin')
                                    <a></a>
                                @endif
                                @if(Auth::check())
                                    @if(Auth::user()->role === 'admin' || 'editor')
                                        <div>
                                            <a href="{{ route('adminticket.edit', $Closedticket->id) }}" class="btn btn-sm btn-outline-primary px-3 m-1">Edit</a>
                                            <form  action="{{ route('adminticket.destroy' , $Closedticket)}}" method="post">
                                                @csrf
                                                @method('delete')
                                                <input class="btn btn-sm btn-outline-danger px-2 m-1" type="submit" value="Delete">
                                            </form>
                                        </div>
                                    @endif
                                @endif
                            @else 
                                <li class="list-group-item">No tickets found.</li>
                            @endif
                        </div>
                    </li>
                @empty
                    <li class="list-group-item">No tickets found.</li>
            @endforelse
        </ul>
    </div>
</div>
@endsection
