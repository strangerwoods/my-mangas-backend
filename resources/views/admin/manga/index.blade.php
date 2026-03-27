@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Mangas</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.manga.create') }}" class="btn btn-primary">Add New Manga</a>
        </div>
    </div>

    @if($mangas->isEmpty())
        <div class="alert alert-info">
            No mangas found. <a href="{{ route('admin.manga.create') }}">Create your first manga!</a>
        </div>
    @else
        <div class="row">
            @foreach($mangas as $manga)
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100">
                        @if($manga->cover_image)
                            <img src="{{ asset('storage/' . $manga->cover_image) }}" class="card-img-top" alt="{{ $manga->title }}" style="height: 300px; object-fit: cover;">
                        @else
                            <div class="card-img-top bg-light d-flex align-items-center justify-content-center" style="height: 300px;">
                                <span class="text-muted">No Cover Image</span>
                            </div>
                        @endif
                        
                        <div class="card-body">
                            <h5 class="card-title">{{ $manga->title }}</h5>
                            
                            @if($manga->description)
                                <p class="card-text text-muted small">{{ Str::limit($manga->description, 100) }}</p>
                            @endif
                            
                            <div class="mb-2">
                                @if($manga->author)
                                    <p class="mb-1"><strong>Author:</strong> {{ $manga->author->name }}</p>
                                @endif
                                @if($manga->publisher)
                                    <p class="mb-1"><strong>Publisher:</strong> {{ $manga->publisher->name }}</p>
                                @endif
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-{{ $manga->status === 'completed' ? 'success' : ($manga->status === 'ongoing' ? 'primary' : 'warning') }}">
                                        {{ ucfirst($manga->status) }}
                                    </span>
                                    @if($manga->volumes)
                                        <span class="text-muted small">{{ $manga->volumes }} volumes</span>
                                    @endif
                                </div>
                            </div>

                            @if($manga->genres->count() > 0)
                                <div class="mb-3">
                                    @foreach($manga->genres as $genre)
                                        <span class="badge bg-secondary">{{ $genre->name }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                        
                        <div class="card-footer bg-white">
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.manga.show', $manga) }}" class="btn btn-sm btn-info flex-grow-1">View</a>
                                <a href="{{ route('admin.manga.edit', $manga) }}" class="btn btn-sm btn-warning flex-grow-1">Edit</a>
                                <form action="{{ route('admin.manga.destroy', $manga) }}" method="POST" class="flex-grow-1" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
