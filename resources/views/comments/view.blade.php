@extends('layouts/app')
@section('content')
    <div class="container m-auto" style="max-width: 700px"> 
        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <ol>
                        <li>{{ $error }}</li>
                    </ol>
                @endforeach
            </div>
        @endif
        @if (session("unanthorized"))
            <div class="alert alert-warning">
                {{ session("unanthorized") }}
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
        <div class="d-flex flex-column w-md-100 m-auto">
            <img src="{{ asset("assests/img/feed1.svg") }}" alt="Comment Image" class="mb-4 w-sm-100 mw-100">
            <div class="w-sm-100">
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
                        <a href="{{ url("/articles/detail/$article->id") }}">
                            <b class="float-end text-white">
                                See Article <i class="bi bi-arrow-up"></i>
                            </b>
                        </a>
                    </li>
                    @foreach ($article->comments as $comment)
                        <li class="list-group-item">
                            <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                            {{ $comment->content }}
                            <div class="small mt-2">
                                <b class="text-primary">{{ $comment->user->name }}</b>,
                                <span class="text-success">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                        </li>
                    @endforeach
                </ul>
                <form action="{{ url("/comments/add") }}" method="POST">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
                    <a href="{{ url("/articles") }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Back
                    </a>
                    <input type="submit" value="Add Comment" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection