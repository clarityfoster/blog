@extends('layouts/app')
@section('content')
    <div class="cotainer m-auto px-3" style="max-width: 700px">
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
        <div class="card p-1 mb-2">
            <div class="card-body">
                @php
                    $colors = ['#FF5733', '#33FF57', '#3357FF', '#F1C40F', '#9B59B6', '#E67E22'];
                    $colorIndex = $article->user->id % count($colors);
                    $color = $colors[$colorIndex];
                @endphp
                   <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <a href="#" class="text-decoration-none">
                                <b class="h4 rounded-circle text-white d-flex justify-content-center align-items-center" style="width: 55px; height: 55px; background-color: 
                                {{ $color }};">
                                    {{ substr($article->user->name, 0, 1) }}
                                </b>
                            </a>
                            <div class="d-flex flex-column">
                                <a href="$" class="text-decoration-none">
                                    <b class="h5 text-muted mt-2">{{ $article->user->name }}</b>
                                </a>
                                <span class="text-success small">{{ $article->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="d-flex flex-column align-items-end">
                            <span class="text-muted small">Category</span>
                            <b class="text-info">{{ $article->category->name }}</b>
                        </div>
                   </div>
                    <h5 class="card-title mt-2">{{ $article->title }}</h5>
                    <p class="card-text">{{ $article->body }}</p>   
                @auth
                     <div class="d-flex justify-content-between mb-2">
                         <div>
                             {{-- Heart Icon --}}
                             <a href="#" class="text-dark">
                                 <i class="bi bi-heart fs-5"></i>
                             </a>
                             {{-- Number of reacts --}}
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
                @endauth 
                @auth
                    <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-danger">Delete</a>
                    <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-info text-white">Edit</a>
                @endauth
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
                    @auth
                        <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                    @endauth
                    {{ $comment->content }}
                    <br>
                    <div class="small mt-2">
                        @if ($comment->user)
                        <b class="text-primary">{{ $comment->user->name }}</b>,
                        @else
                            <b>Null</b>
                        @endif
                        <span class="text-success">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </li>
            @endforeach
        </ul>
        @auth
            <form action="{{ url("/comments/add") }}" method="POST">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
                <a href="{{ url("/articles") }}" class="btn btn-secondary">
                    <i class="bi bi-arrow-left"></i> Back
                </a>
                <input type="submit" value="Add Comment" class="btn btn-primary">
            </form>
        @endauth
    </div>
@endsection