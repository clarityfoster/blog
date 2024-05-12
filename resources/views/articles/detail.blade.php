@extends('layouts/app')
@section('content')
    <div class="cotainer m-auto" style="max-width: 700px">
        @if (session('info')) 
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        <a href="{{ url("/articles") }}" class="btn btn-secondary mb-2">
            <i class="bi bi-arrow-left"></i>
        </a>
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle small text-muted">
                    {{ $article->created_at->diffForHumans() }}
                </div>
                <p class="card-text">{{ $article->body }}</p>           
                <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-danger">Delete</a>
                <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-info text-white">Edit</a>
            </div>
        </div>
    </div>
@endsection