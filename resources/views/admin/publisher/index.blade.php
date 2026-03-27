@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-6">
            <h1>Publishers</h1>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.publishers.create') }}" class="btn btn-primary">Add New Publisher</a>
        </div>
    </div>

    @if($publishers->isEmpty())
        <div class="alert alert-info">
            No publishers found. <a href="{{ route('admin.publishers.create') }}">Create your first publisher!</a>
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
                    @foreach($publishers as $publisher)
                        <tr>
                            <td>{{ $publisher->name }}</td>
                            <td>
                                <span class="badge bg-info">{{ $publisher->manga->count() }}</span>
                            </td>
                            <td>
                                <a href="{{ route('admin.publishers.show', $publisher) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('admin.publishers.edit', $publisher) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('admin.publishers.destroy', $publisher) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure?');">
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
