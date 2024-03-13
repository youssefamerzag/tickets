@extends('layouts.app')

@section('content')
<div class="container">
    @if(Auth::user()->role == 'admin')
        <a class="btn btn-primary px-4 mb-3" href="{{ route('admin.profile')}}">Back</a>
    @else
        <a class="btn btn-primary px-4 mb-3" href="{{ route('users.show')}}">Back</a>
    @endif
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Edit Ticket</h5>
        </div>
        <div class="card-body">
            <form id="updateForm" action="{{ route('tickets.update', $ticket) }}" method="post">
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
                    <label for="ticket-title">file (optional):</label>
                    <input type="file" class="form-control @error('ticket-file') is-invalid @enderror" id="ticket-file" name="ticket-file" value="{{ old('ticket-file') }}" placeholder="Enter file">
                    @error('ticket-file')
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
                </div>
                @if(Auth::user()->role == 'admin')
                <div class="form-group">
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
                @endif
                <button onclick="confirmation()" type="button" class="btn btn-success mt-3">Update Ticket</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmation() {
            Swal.fire({
                title: "Are you sure to delete this user?",
                text: "You will not be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, update it!",
                cancelButtonText: "Cancel",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('updateForm').submit();
                    Swal.fire({
                    title: "Done",
                    text: "the ticket has been updated!",
                    icon: "success"
                });
                }
            });
        }
    </script>
</div>
@endsection
