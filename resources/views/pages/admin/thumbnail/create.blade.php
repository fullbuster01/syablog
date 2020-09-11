@extends('layouts.admin')
@section('title')
    <h1>Thumbnail</h1>
@endsection
@section('content')
<div class="card col-md-8">
    <div class="card-body">
        <form action="{{ route('thumbnail.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="post_id">Post</label>
                    <select name="post_id" required class="form-control" id="post_id">
                            <option disabled selected>Pilih Post Berdasarkan Id</option>
                            @foreach ($posts as $post)
                            @role('author')
                            @if ($post->user_id == Auth::user()->id)
                            <option value="{{ old('post_id') ?? $post->id }}">{{ $post->id }}</option>
                            @endif
                            @else
                            <option value="{{ old('post_id') ?? $post->id }}">{{ $post->id }}</option>
                            @endrole
                            @endforeach
                    </select>
            </div>
            <div class="form-group">
            <label for="image">thumbnail</label>
            <input type="file" name="image" class="form-control" placeholder="Thumbnail">
            @error('image')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ route('thumbnail.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection