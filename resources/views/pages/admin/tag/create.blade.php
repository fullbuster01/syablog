@extends('layouts.admin')
@section('title')
    <h1>Tambah Tag</h1>
@endsection
@section('content')
<div class="card col-md-8">
    <div class="card-body">
        <form action="{{ route('tag.store') }}" method="post">
            @csrf
            <div class="form-group">
            <label for="name">Tag</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ route('tag.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection