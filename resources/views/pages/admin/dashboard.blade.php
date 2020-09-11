@extends('layouts.admin')
@section('title')
    <h1>Dashboard</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Administrator</h4>
                    </div>
                    <div class="card-body">
                        {{ $admininistrator }}
                    </div>
                </div>
            </div>
        </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="fas fa-users"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Author</h4>
                    </div>
                    <div class="card-body">
                        {{ $author }}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                    <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Post</h4>
                    </div>
                    <div class="card-body">
                        {{ $post }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection