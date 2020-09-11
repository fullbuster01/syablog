@extends('layouts.admin')
@section('title')
    <h1>Profile</h1>
@endsection
@section('content')
<div class="col-md-6">

    <form>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" value="{{ $user->name }}" readonly>
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" class="form-control" id="username" value="{{ $user->username }}" readonly>
        </div>
        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
        </div>
        {{-- <div class="form-group">
            <label for="type">Type</label>
            <input type="text" class="form-control" id="type" value="{{ $user->type }}">
        </div> --}}
        {{-- <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil-alt"> Ubah</i></a> --}}
    </form>
</div>
@endsection