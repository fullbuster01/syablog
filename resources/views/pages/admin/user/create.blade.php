@extends('layouts.admin')
@section('title')
    <h1>Tambah User</h1>
@endsection
@section('content')
<div class="card col-md-8">
    <div class="card-body">
        <form action="{{ route('user.store') }}" method="post">
            @csrf
            <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" value="{{ old('username') }}">
            @error('username')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
            <label for="type">Type User</label>
            <select class="form-control" name="type" id="type" value="{{ old('type') }}">
                {{-- <option disabled selected>Choose one!</option> --}}
                <option value="0">Author</option>
                {{-- <option value="1">Administrator</option> --}}
            </select>
            @error('type')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}">
            @error('password')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <button class="btn btn-primary" type="submit">Save</button>
        <a href="{{ route('user.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
</div>
@endsection