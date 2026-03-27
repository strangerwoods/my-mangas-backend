@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('admin.manga.index') }}" class="btn btn-secondary mb-3">← Back to Mangas</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            @if($manga->cover_image)
                <img src="{{ asset('storage/' . $manga->cover_image) }}" class="img-fluid rounded" alt="{{ $manga->title }}">
            @else
                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 500px;">
                    <span class="text-muted">No Cover Image</span>
                </div>
            @endif
        </div>

        <div class="col-md-8">
            <h1>{{ $manga->title }}</h1>

            <div class="mb-4">
                <span class="badge bg-{{ $manga->status === 'completed' ? 'success' : ($manga->status === 'ongoing' ? 'primary' : 'warning') }} fs-6">
                    {{ ucfirst($manga->status) }}
                </span>
                @if($manga->year)
                    <span class="badge bg-info fs-6">{{ $manga->year }}</span>
                @endif
            </div>

            <div class="row mb-4">
                <div class="col-md-6">
                    <h5>Information</h5>
                    <table class="table table-sm">
                        <tr>
                            <th>Author:</th>
                            <td>{{ $manga->author ? $manga->author->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Publisher:</th>
                            <td>{{ $manga->publisher ? $manga->publisher->name : 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Volumes:</th>
                            <td>{{ $manga->volumes ?? 'Unknown' }}</td>
                        </tr>
                        <tr>
                            <th>Published:</th>
                            <td>{{ $manga->year }}</td>
                        </tr>
                    </table>
                </div>

                @if($manga->genres->count() > 0)
                    <div class="col-md-6">
                        <h5>Genres</h5>
                        <div>
                            @foreach($manga->genres as $genre)
                                <span class="badge bg-secondary fs-6">{{ $genre->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            @if($manga->description)
                <div class="mb-4">
                    <h5>Description</h5>
                    <p>{{ $manga->description }}</p>
                </div>
            @endif

            <div class="d-flex gap-2">
                <a href="{{ route('admin.manga.edit', $manga) }}" class="btn btn-warning">Edit</a>
                <form action="{{ route('admin.manga.destroy', $manga) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
