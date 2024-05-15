@auth
    <div class="d-flex justify-content-between mb-2">
        <div>
            @php
                $like = $article->likes->where('user_id', auth()->user()->id)->first();
            @endphp
            @if ($like)  
                <form action="{{ url("/reacts/unlike/$like->id") }}" method="post">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <button type="submit" class="btn btn-link p-0">
                        <i class="bi bi-heart-fill fs-4 text-danger"></i>
                    </button>
                    <a href="#" class="text-decoration-none text-dark">
                        <b>{{ count($article->likes) }}</b>
                    </a>
                </form>
            @else
                <form action="{{ url("/reacts/like")}}"  method="post">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <button type="submit" class="btn btn-link p-0">
                        <i class="bi bi-heart fs-4 text-danger"></i>
                    </button>
                    <a href="#" class="text-decoration-none text-dark">
                        <b>{{ count($article->likes) }}</b>
                    </a>
                </form>
            @endif
        </div> 
        <div>
            @if (count($article->comments) <= 0)
                <a href="{{ url("/comments/view/$article->id") }}" class="text-decoration-none text-dark">
                    <i class="bi bi-chat-dots fs-4"></i>
                </a>
            @else
                <a href="{{ url("/comments/view/$article->id")}}" class="text-decoration-none text-dark">
                    <i class="bi bi-chat-dots fs-4"></i>
                    <b>{{ count($article->comments) }}</b>
                </a>
            @endif
        </div> 
    </div>
@endauth 