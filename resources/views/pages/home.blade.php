@extends('layouts.app')
@section('banner')
{{-- <!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container"> --}}
        <div id="hot-post" class="row hot-post">
            {{-- @foreach ($banner1 as $banner) --}}
            <!-- row -->
            {{-- @if ($banner1 != $posts) --}}
                
            <div class="col-md-8 hot-post-left">
                <!-- post -->
                <div class="post post-thumb">
                    <a style="color: #ee4266;" class="post-img" href="{{ route('post', $banner1->slug) }}">
                        @foreach ($banner1->thumbnail as $item)
                            
                        <img src="{{ asset('storage/'.$item->xl) }}" alt="">
                        @endforeach
                    </a>
                    <div class="post-body">
                        <div class="post-category">
                            <a style="color: #ee4266;" href="{{ route('category', $banner1->category->slug) }}">{{ $banner1->category->name }}</a>
                            <div>
                                @foreach ($banner1->tags as $tag)
                                    <a href="{{ route('tag', $tag->slug) }}" class="text-primary">
                                        <small>{{ $tag->name }}</small>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <h3 class="post-title title-lg"><a href="{{ route('post', $banner1->slug) }}">{{ $banner1->title }}</a></h3>
                        <ul class="post-meta">
                            <li><a href="author.html">{{'@'. $banner1->user->username }}</a></li>
                            <li>20 April 2018</li>
                        </ul>
                    </div>
                </div>
                <!-- /post -->
            </div>
            {{-- @endif --}}
            {{-- @endforeach --}}
            <div class="col-md-4 hot-post-right">
                <!-- post -->
                <div class="post post-thumb">
                    <a style="color: #ee4266;" class="post-img" href="{{ route('post', $banner2->slug) }}">
                        @foreach ($banner2->thumbnail as $item)
                            
                        <img src="{{ asset('/storage/'.$item->l) }}"" alt="" style="height: 281px;">
                        @endforeach
                    </a>
                    <div class=" post-body">
                        <div class="post-category">
                            <a style="color: #ee4266;" href="{{ route('category', $banner2->category->slug) }}">{{ $banner2->category->name }}</a>
                            <div>
                                @foreach ($banner2->tags as $tag)
                                    <a href="{{ route('tag', $tag->slug) }}" class="text-primary">
                                        <small>{{ $tag->name }}</small>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <h3 class="post-title"><a href="{{ route('post', $banner2->slug) }}">{{ $banner2->title }}</a>
                        </h3>
                        <ul class="post-meta">
                            <li><a href="author.html">{{'@'. $banner2->user->username }}</a></li>
                            <li>20 April 2018</li>
                        </ul>
                    </div>
                </div>
            <!-- /post -->

            <!-- post -->
                <div class="post post-thumb">
                    <a style="color: #ee4266;" class="post-img" href="{{ route('post', $banner3->slug) }}">
                        @foreach ($banner3->thumbnail as $item)
                            
                        <img src="{{ asset('/storage/'.$item->l) }}"" alt="" style="height: 281px;width: 375px">
                        @endforeach
                    </a>
                    <div class=" post-body">
                        <div class="post-category">
                            <a style="color: #ee4266;" href="{{ route('category', $banner3->category->slug) }}">{{ $banner3->category->name }}</a>
                            <div>
                                @foreach ($banner3->tags as $tag)
                                    <a href="{{ route('tag', $tag->slug) }}" class="text-primary">
                                        <small>{{ $tag->name }}</small>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <h3 class="post-title"><a href="{{ route('post', $banner3->slug) }}">{{ $banner3->title }}.</a></h3>
                        <ul class="post-meta">
                            <li><a href="author.html">{{'@'. $banner3->user->username }}</a></li>
                            <li>20 April 2018</li>
                        </ul>
                    </div>
                </div>
            <!-- /post -->
            </div>
            <!-- /row -->
            {{-- @endforeach --}}
        </div>
	{{-- </div>
	<!-- /container -->
</div>
<!-- /SECTION --> --}}
        
@endsection
@section('content')

    <!-- row -->
    <div class="row">
        <div class="col-md-12">
            <div class="section-title">
                <h2 class="title">Postingan Terbaru</h2>
            </div>
        </div>
        @forelse ($posts as $post)
        <!-- post -->
        <div class="col-md-6">
            <div class="post">
                <a style="color: #ee4266;" class="post-img" href="{{ route('post', $post->slug) }}">
                    @foreach ($post->thumbnail as $item)
                    <img src="{{ asset('/storage/'.$item->m) }}" alt="thumbnail">
                    @endforeach
                    </a>
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
                        <li>{{ $post->created_at->diffForHumans() }}</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /post -->
        @empty

        @endforelse
    </div>
            <div class="section-row loadmore text-center">
                <a href="{{ route('all.post') }}" class="primary-button">Load More</a>
            </div>
    <!-- /row -->

@endsection