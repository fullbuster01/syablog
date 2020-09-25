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
                <textarea type="text" name="content" class="form-control content">{!! old('content') ?? $post->content !!}</textarea>
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
        <script src="https://cdn.tinymce.com/4/tinymce.min.js"></script>
    <script>
        var editor_config = {
            height: 500,
            path_absolute : "/",
            selector: "textarea.content",
            plugins: [
            "advlist autolink lists link image charmap print preview hr anchor pagebreak",
            "searchreplace wordcount visualblocks visualchars code fullscreen",
            "insertdatetime media nonbreaking save table contextmenu directionality",
            "emoticons template paste textcolor colorpicker textpattern"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
            relative_urls: false,
            file_browser_callback : function(field_name, url, type, win) {
            var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
            var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

            var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
            if (type == 'image') {
                cmsURL = cmsURL + "&type=Images";
            } else {
                cmsURL = cmsURL + "&type=Files";
            }

            tinyMCE.activeEditor.windowManager.open({
                file : cmsURL,
                title : 'Filemanager',
                width : x * 0.8,
                height : y * 0.8,
                resizable : "yes",
                close_previous : "no"
            });
            }
        };

        tinymce.init(editor_config);
    </script>
@endpush