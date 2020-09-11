@extends('layouts.app')
{{-- @section('banner')
    
@endsection --}}
@section('content')
    <div class="col-md-8">
        @foreach ($posts as $post)
                <!-- post -->
            <div class="post post-row">
                @foreach ($post->thumbnail as $item)
                    
                <a class="post-img" href="{{ route('post', $post->slug) }}"><img src="{{ asset('storage/'.$item->m) }}" alt="thubnail"></a>
                @endforeach
                <div class="post-body">
                    <div class="post-category">
                        <a style="color: #ee4266;" href="{{ route('category', $post->category->slug) }}">{{ $post->category->name }}</a>
                        <div>
                            @foreach ($post->tags as $tag)
                                <a href="{{ route('tag', $tag->slug) }}" class="text-primary">
                                    <small>{{ $tag->name }}</small>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <h3 class="post-title"><a href="{{ route('post', $post->slug) }}">{{ $post->title }}</a></h3>
                    <ul class="post-meta">
                        <li><a href="author.html">{{'@'. $post->user->username }}</a></li>
                        <li>{{ $post->created_at->format('d, M Y') }}</li>
                    </ul>
                    {{-- <p>{!! Str::limit($post->content, 130, '...') !!}</p> --}}
                </div>
            </div>
            <!-- /post -->
        @endforeach

        <div class="d-flex justify-content-end-center">
        {{ $posts->links() }}
        </div>
    </div>
@endsection