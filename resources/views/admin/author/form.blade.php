@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary mb-3">← Back to Authors</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">{{ isset($author) ? 'Edit Author' : 'Add New Author' }}</h1>

            <form action="{{ isset($author) ? route('admin.authors.update', $author) : route('admin.authors.store') }}" method="POST">
                @csrf
                @if(isset($author))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $author->name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="bio" class="form-label">Biography</label>
                    <textarea class="form-control" id="bio" name="bio" rows="5">{{ old('bio', $author->bio ?? '') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="nationality" class="form-label">Nationality</label>
                    <input type="text" class="form-control" id="nationality" name="nationality" value="{{ old('nationality', $author->nationality ?? '') }}">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">{{ isset($author) ? 'Update Author' : 'Add Author' }}</button>
                    <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
