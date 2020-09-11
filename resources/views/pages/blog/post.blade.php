@extends('layouts.app')
@section('banner')
    <header id="header">
        <!-- PAGE HEADER -->
        <div id="post-header" class="page-header">
            @foreach ($post->thumbnail as $item)
                
            <div class="page-header-bg" style="background-image: url('{{ Storage::url($item->xxl) }}'); background-size: cover; background-repeat: no-repeat;"
                data-stellar-background-ratio="1"></div>
            @endforeach
            <div class="container">
                <div class="row">
                    <div class="col-md-10">
                        <div class="post-category">
                            <a href="{{ route('category', $post->category->slug) }}">{{ $post->category->name }}</a> &middot; | &middot; @foreach ($post->tags as $tag)
                                <a href="{{ route('tag', $tag->slug) }}">
                                    <small>{{ $tag->name }}</small>
                                </a>
                            @endforeach
                        </div>
                        <h1>{{ $post->title }}</h1>
                        <ul class="post-meta">
                            <li><a href="author.html">{{'@'. $post->user->username }}</a></li>
                            <li>{{ $post->created_at->format('d, M Y') }}</li>
                            {{-- <li><i class="fa fa-comments"></i> 3</li> --}}
                            <li><i class="fa fa-eye"></i> {{ views($post)->count() }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /PAGE HEADER -->
    </header>
@endsection
@section('content')
    <p>{!! nl2br($post->content) !!}</p>
@endsection