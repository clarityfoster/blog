@extends('layouts/app')
@section('content')
    <div class="cotainer m-auto" style="max-width: 700px">
        @foreach ($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <div class="card-subtitle small text-muted">
                        {{ $article->created_at->diffForHumans() }}
                    </div>
                    <p class="card-text">{{ $article->body }}</p>
                    <div>
                        <i class="fas fa-heart"></i>
                    </div>
                                  
                    <a href="{{ url("/articles/detail/$article->id") }}" class="card-link">Detail</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection