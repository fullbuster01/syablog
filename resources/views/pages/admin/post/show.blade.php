@extends('layouts.admin')
@section('title')
    <h1>Post</h1>
@endsection
@section('content')
<h4>Detail Post : {{ $posts->title }}</h4>
        <table class="table table-hover">
            <thead>
                <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Tag</th>
                <th>Content</th>
                </tr>
            </thead>
            <tbody>
                    <tr class="py-1">
                    <td>{{ $posts->title }}</td>
                    <td>{{ $posts->category->name }}</td>
                    <td>@foreach ($posts->tags as $tag)
                        <ul><li>{{ $tag->name }}</li></ul>
                    @endforeach</td>
                    <td colspan="2">{!! nl2br($posts->content) !!}</td>
                </tr>
            </tbody>
        </table>
        <a href="{{ route('post.index') }}" class="btn btn-secondary">Back</a>
@endsection