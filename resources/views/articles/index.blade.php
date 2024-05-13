@extends('layouts/app')
@section('content')
    <div class="cotainer m-auto" style="max-width: 700px">
        @if(session('danger'))
            <div class="alert alert-danger">
                {{ session('danger') }}
            </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
        {{ $articles->links('pagination::bootstrap-4') }}
        @foreach ($articles as $article)
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <div class="card-subtitle small text-muted">
                        {{ $article->created_at->diffForHumans() }},
                        Category: <b>{{ $article->category->name  }}</b>
                    </div>
                    <p class="card-text">{{ $article->body }}</p>      

                   <div class="d-flex justify-content-between mb-2">
                        <div>
                            <i class="bi bi-heart fs-5"></i>
                            <a href="" class="text-decoration-none text-dark">
                                
                            </a>
                        </div> 
                        <div>
                            <i class="bi bi-hand-thumbs-down fs-5"></i>
                            <a href="" class="text-decoration-none text-dark">
                                
                            </a>
                        </div> 
                        <div>
                            @if (count($article->comments) <= 0)
                                <i class="bi bi-chat-dots fs-5"></i>
                            @else
                                <i class="bi bi-chat-dots fs-5"></i>
                                <a href="" class="text-decoration-none text-dark">
                                    {{ count($article->comments) }}
                                </a>
                            @endif
                        </div> 
                    </div>  
                    <a href="{{ url("/articles/detail/$article->id") }}" class="text-decoration-none">
                        Detail <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection