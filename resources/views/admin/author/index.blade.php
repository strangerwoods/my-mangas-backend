@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Authors</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.authors.create') }}" class="btn btn-primary">Add New Author</a>
        </div>
    </div>

    @if($authors->isEmpty())
        <div class="alert alert-info">
            No authors found. <a href="{{ route('admin.authors.create') }}">Create your first author!</a>
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
                    @foreach($authors as $author)
                        <tr>
                            <td>{{ $author->name }}</td>
                            <td>
                                <span class="badge bg-info">{{ $author->manga->count() }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.authors.show', $author) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.authors.edit', $author) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.authors.destroy', $author) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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
