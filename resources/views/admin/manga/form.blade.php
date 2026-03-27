@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('admin.manga.index') }}" class="btn btn-secondary mb-3">← Back to Mangas</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">{{ isset($manga) ? 'Edit Manga' : 'Add New Manga' }}</h1>

            <form action="{{ isset($manga) ? route('admin.manga.update', $manga) : route('admin.manga.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($manga))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="title" class="form-label">Title *</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $manga->title ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $manga->description ?? '') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="author_id" class="form-label">Author *</label>
                            <select class="form-select" id="author_id" name="author_id" required>
                                <option value="">Select an author</option>
                                @foreach(\App\Models\Author::all() as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id', $manga->author_id ?? '') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="publisher_id" class="form-label">Publisher *</label>
                            <select class="form-select" id="publisher_id" name="publisher_id" required>
                                <option value="">Select a publisher</option>
                                @foreach(\App\Models\Publisher::all() as $publisher)
                                    <option value="{{ $publisher->id }}" {{ old('publisher_id', $manga->publisher_id ?? '') == $publisher->id ? 'selected' : '' }}>{{ $publisher->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="volumes" class="form-label">Volumes</label>
                            <input type="number" class="form-control" id="volumes" name="volumes" value="{{ old('volumes', $manga->volumes ?? '') }}">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control" id="year" name="year" min="1900" max="2099" value="{{ old('year', $manga->year ?? '') }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status *</label>
                    <select class="form-select" id="status" name="status" required>
                        <option value="">Select a status</option>
                        <option value="ongoing" {{ old('status', $manga->status ?? '') === 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ old('status', $manga->status ?? '') === 'completed' ? 'selected' : '' }}>Completed</option>
                        <option value="hiatus" {{ old('status', $manga->status ?? '') === 'hiatus' ? 'selected' : '' }}>Hiatus</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="cover_image" class="form-label">Cover Image</label>
                    <input type="file" class="form-control" id="cover_image" name="cover_image" accept="image/*">
                    @if(isset($manga) && $manga->cover_image)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $manga->cover_image) }}" alt="{{ $manga->title }}" style="max-width: 200px; max-height: 300px;">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="delete_cover_image" name="delete_cover_image" value="1">
                                <label class="form-check-label" for="delete_cover_image">
                                    Delete current image
                                </label>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="mb-3">
                    <label class="form-label">Genres</label>
                    <div>
                        @foreach(\App\Models\Genre::all() as $genre)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="genre_{{ $genre->id }}" name="genres[]" value="{{ $genre->id }}" {{ isset($manga) && $manga->genres->contains($genre->id) ? 'checked' : '' }}>
                                <label class="form-check-label" for="genre_{{ $genre->id }}">
                                    {{ $genre->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">{{ isset($manga) ? 'Update Manga' : 'Add Manga' }}</button>
                    <a href="{{ route('admin.manga.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
