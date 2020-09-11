@extends('layouts.admin')
@section('title')
    <h1>Ubah User</h1>
@endsection
@section('content')
<div class="card col-md-8">
    <div class="card-body">
        <form action="{{ route('user.update', $user->id) }}" method="post">
            @method('PUT')
            @csrf
            <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') ?? $user->name }}">
            @error('name')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" name="username" id="username" value="{{ $user->username }}" readonly>
            @error('username')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
            <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{  $user->email}}" readonly>
            @error('email')
                <div class="text-danger mt-2">
                    {{ $message }}
                </div>
            @enderror
            <label for="type">Type User</label>
            <select class="form-control" name="type" id="type">
                @if ($user->type == 0)
                    <option value="0" selected>Author</option>
                @else
                    <option disabled selected>Choose one!</option>
                    <option value="0" @if ($user->type == 0)
                        selected
                    @endif>Author</option>
                    <option value="1" @if ($user->type == 1)
                        selected
                    @endif>Administrator</option>
                @endif
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