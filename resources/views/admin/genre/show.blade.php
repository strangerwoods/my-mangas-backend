@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('admin.genres.index') }}" class="btn btn-secondary mb-3">← Back to Genres</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <h1>{{ $genre->name }}</h1>

            <div class="mb-4">
                <h5>Mangas ({{ $genre->manga->count() }})</h5>
                @if($genre->manga->count() > 0)
                    <div class="list-group">
                        @foreach($genre->manga as $manga)
                            <a href="{{ route('admin.manga.show', $manga) }}" class="list-group-item list-group-item-action">
                                {{ $manga->title }}
                                <span class="badge bg-secondary float-end">{{ ucfirst($manga->status) }}</span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No mangas yet</p>
                @endif
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.genres.edit', $genre) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.genres.destroy', $genre) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
