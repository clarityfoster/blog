@extends('layouts/app')
@section('content')
    <div class="cotainer m-auto" style="max-width: 700px">
        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <ol>
                        <li>{{ $error }}</li>
                    </ol>
                @endforeach
            </div>
        @endif
        @if (session('info')) 
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
        @if (session('cm-created')) 
            <div class="alert alert-success">
                {{ session('cm-created') }}
            </div>
        @endif
        @if (session('cm-delete')) 
            <div class="alert alert-danger">
                {{ session('cm-delete') }}
            </div>
        @endif
        <a href="{{ url("/articles") }}" class="btn btn-secondary mb-2">
            <i class="bi bi-arrow-left"></i>
        </a>
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
                            {{ count($article->comments) }}
                        @endif
                    </div> 
                </div>        
                <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-danger">Delete</a>
                <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-info text-white">Edit</a>
            </div>
        </div>
        <ul class="list-group mb-2">
            <li class="list-group-item active">
                <b>
                    @if ( count($article->comments) <= 1 )
                        Comment
                    @else
                        Comments
                    @endif
                    ( {{ count($article->comments) }} )
                </b>
            </li>
            @foreach ($article->comments as $comment)
                <li class="list-group-item">
                    <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                    {{ $comment->content }}
                </li>
            @endforeach
        </ul>
        <form action="{{ url("/comments/add") }}" method="POST">
            @csrf
            <input type="hidden" name="article_id" value="{{ $article->id }}">
            <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
            <input type="submit" value="Add Comment" class="btn btn-primary">
        </form>
    </div>
@endsection