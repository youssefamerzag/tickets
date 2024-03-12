@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Create New Ticket</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('tickets.store') }}" method="POST"  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="ticket-title">Title:</label>
                    <input type="text" class="form-control @error('ticket-title') is-invalid @enderror" id="ticket-title" name="ticket-title" value="{{ old('ticket-title') }}" placeholder="Enter title">
                    @error('ticket-title')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ticket-description">Description:</label>
                    <textarea class="form-control @error('ticket-description') is-invalid @enderror" id="ticket-description" name="ticket-description" rows="4" placeholder="Enter description">{{ old('ticket-description') }}</textarea>
                    @error('ticket-description')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="ticket-file">File (optional):</label>
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
                        <option value="">Select type</option>
                        <option value="Bug" {{ old('ticket-type') == 'Bug' ? 'selected' : '' }}>Bug</option>
                        <option value="Tach" {{ old('ticket-type') == 'Tach' ? 'selected' : '' }}>Tache</option>
                    </select>
                    @error('ticket-type')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success mt-3">Create Ticket</button>
            </form>
        </div>
    </div>
</div>
@endsection
