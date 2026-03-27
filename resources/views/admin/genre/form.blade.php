@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary mb-3">← Back to Genres</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">{{ isset($genre) ? 'Edit Genre' : 'Add New Genre' }}</h1>

            <form action="{{ isset($genre) ? route('admin.genres.update', $genre) : route('admin.genres.store') }}" method="POST">
                @csrf
                @if(isset($genre))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $genre->name ?? '') }}" required>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">{{ isset($genre) ? 'Update Genre' : 'Add Genre' }}</button>
                    <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
