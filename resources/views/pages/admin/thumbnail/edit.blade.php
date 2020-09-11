@extends('layouts.admin')
@section('title')
    <h1>Thumbanil</h1>
@endsection
@section('content')
<div class="card col-md-8">
    <div class="card-body">
        <form action="{{ route('thumbnail.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="travel_packages_id">Post</label>
                    <select name="post_id" required class="form-control">
                        <option disabled selected>Pilih Post</option>
                            @foreach ($posts as $post)
                            <option value="{{ $post->id }}">{{ $post->id }}</option>
                            @endforeach
                    </select>
            </div>
            <div class="form-group">
            <label for="image">thumbnail</label>
            <input type="file" name="image" class="form-control" placeholder="Thumbnail">
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