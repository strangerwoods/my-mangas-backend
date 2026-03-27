@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Genres</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.genres.create') }}" class="btn btn-primary">Add New Genre</a>
        </div>
    </div>

    @if($genres->isEmpty())
        <div class="alert alert-info">
            No genres found. <a href="{{ route('admin.genres.create') }}">Create your first genre!</a>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mangas</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($genres as $genre)
                        <tr>
                            <td>{{ $genre->name }}</td>
                            <td>
                                <span class="badge bg-info">{{ $genre->manga->count() }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.genres.show', $genre) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.genres.edit', $genre) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.genres.destroy', $genre) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
