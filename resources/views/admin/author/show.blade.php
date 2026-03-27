@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary mb-3">← Back to Authors</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <h1>{{ $author->name }}</h1>

            @if($author->nationality)
                <div class="mb-3">
                    <strong>Nationality:</strong> {{ $author->nationality }}
                </div>
            @endif

            @if($author->bio)
                <div class="mb-4">
                    <h5>Biography</h5>
                    <p>{{ $author->bio }}</p>
                </div>
            @endif

            <div class="mb-4">
                <h5>Mangas ({{ $author->manga->count() }})</h5>
                @if($author->manga->count() > 0)
                    <div class="list-group">
                        @foreach($author->manga as $manga)
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
                <a href="{{ route('admin.authors.edit', $author) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.authors.destroy', $author) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
