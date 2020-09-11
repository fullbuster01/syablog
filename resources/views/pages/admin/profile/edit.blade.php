@extends('layouts.admin')
@section('title')
    <h1>ubah Profile</h1>
@endsection
@section('content')
<div class="col-md-6">

    <form action="{{ route('profile.update', $user->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">name</label>
            <input type="text" class="form-control" id="name" value="{{ $user->name }}">
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
        </div>
        {{-- <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control" id="type" value="{{ $user->type }}">
        </div> --}}
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ route('profile') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection