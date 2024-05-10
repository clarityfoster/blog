@extends('layouts/app')
@section('content')
    <div class="cotainer m-auto" style="max-width: 700px">
        <div class="card mb-2">
            <div class="card-body">
                <h5 class="card-title">{{ $article->title }}</h5>
                <div class="card-subtitle small text-muted">
                    {{ $article->created_at->diffForHumans() }}
                </div>
                <p class="card-text">{{ $article->body }}</p>           
                <a href="{{ url("/articles/detail/{id}") }}" class="btn btn-danger">Delete</a>
                
            </div>
        </div>
    </div>
@endsection