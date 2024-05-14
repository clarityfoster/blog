@extends('layouts/app')
@section('content')
    <div class="container m-auto" style="max-width: 700px">
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
                                <a href="" class="text-decoration-none text-dark"></a>
                            </div> 
                            <div>
                                <i class="bi bi-hand-thumbs-down fs-5"></i>
                                <a href="" class="text-decoration-none text-dark"></a>
                            </div> 
                            <div>
                                @if (count($article->comments) <= 0)
                                    <a href="{{ url("/comments/view/$article->id") }}" class="text-decoration-none text-dark">
                                        <i class="bi bi-chat-dots fs-5"></i>
                                    </a>
                                @else
                                    <a href="{{ url("/comments/view/$article->id") }}" class="text-decoration-none text-dark">
                                        <i class="bi bi-chat-dots fs-5"></i>
                                        {{ count($article->comments) }}
                                    </a>
                                @endif
                            </div> 
                        </div>
                   @endauth 
                    <a href="{{ url("/articles/detail/$article->id") }}" class="text-decoration-none">
                        Detail <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
