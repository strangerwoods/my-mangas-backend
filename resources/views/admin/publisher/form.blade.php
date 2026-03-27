@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12">
            <a href="{{ route('admin.publishers.index') }}" class="btn btn-secondary mb-3">← Back to Publishers</a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h1 class="mb-4">{{ isset($publisher) ? 'Edit Publisher' : 'Add New Publisher' }}</h1>

            <form action="{{ isset($publisher) ? route('admin.publishers.update', $publisher) : route('admin.publishers.store') }}" method="POST">
                @csrf
                @if(isset($publisher))
                    @method('PUT')
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Name *</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $publisher->name ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label for="country" class="form-label">Country</label>
                    <input type="text" class="form-control" id="country" name="country" value="{{ old('country', $publisher->country ?? '') }}">
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">{{ isset($publisher) ? 'Update Publisher' : 'Add Publisher' }}</button>
                    <a href="{{ route('admin.publishers.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
