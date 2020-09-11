@extends('layouts.admin')
@section('title')
    <h1>Ubah Post</h1>
@endsection
@section('content')
<div class="card col-md-8">
    <div class="card-body">
        <form action="{{ route('post.update', $post->id) }}" method="post" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') ?? $post->title }}">
            @error('title')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="form-group">
                <label for="category">Kategori</label>
                <select name="category" id="category" class="form-control">
                    <option disabled selected>Choose one!</option>
                        @foreach ($categories as $category)
                            <option {{ $category->id == $post->category_id ? 'selected' : '' }} value="{{ old('category') ?? $category->id }}">{{ $category->name }}</option>
                        @endforeach
                </select>
                @error('category')
                    <div class="text-danger mt-2">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="tag">Tag</label>
                <select name="tag[]" id="tag" class="form-control select2" multiple>
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" 
                        @foreach ($post->tags as $p)
                        @if ($p->id == $tag->id)
                            selected
                        @endif
                        @endforeach>{{ $tag->name }}</option>
                    @endforeach
                    {{-- @foreach ($post->tags as $tag)
                        <option selected value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach --}}
                </select>
                @error('tag')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="content">Konten</label>
                <textarea type="text" name="content" id="content" class="form-control content">{{ old('content') ?? $post->content }}</textarea>
                @error('content')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button class="btn btn-primary" type="submit">Save</button>
            <a href="{{ route('post.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection
@push('add-on-script')
        {{-- <script src="https://cdn.ckeditor.com/ckeditor5/20.0.0/classic/ckeditor.js"></script> --}}
        <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        // ClassicEditor
        // .create( document.querySelector( '#content' ) )
        // .then( editor => {
        // console.log( editor );
        // } )
        // .catch( error => {
        // console.error( error );
        // } );
        CKEDITOR.replace( 'content' );
    </script>
@endpush