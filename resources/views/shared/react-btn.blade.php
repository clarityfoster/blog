@auth
    @php
        $like = $article->likes->where('user_id', auth()->user()->id)->first();
    @endphp
    <div class="d-flex justify-content-between mb-2">
        <div>
            @if ($like)
                <form action="{{ url("/reacts/unlike/$like->id") }}" method="post">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <button type="submit" class="btn btn-link p-0">
                        <i class="bi bi-heart-fill fs-4 text-danger"></i>
                    </button>
                    <a href="{{ url("/reacts/view/$article->id") }}" class="text-decoration-none text-dark">
                        @if (count($article->likes) >= 1)
                            <b>{{ count($article->likes) }}</b>
                        @endif
                    </a>
                </form>
            @else
                <form action="{{ url('/reacts/like') }}" method="post">
                    @csrf
                    <input type="hidden" name="article_id" value="{{ $article->id }}">
                    <button type="submit" class="btn btn-link p-0">
                        <i class="bi bi-heart fs-4 text-danger"></i>
                    </button>
                    <a href="{{ url("/reacts/view/$article->id") }}" class="text-decoration-none text-dark">
                        @if (count($article->likes) >= 1)
                            <b>{{ count($article->likes) }}</b>
                        @endif
                    </a>
                </form>
            @endif
        </div>
        <div>
            @php
                $comment = $article->comments->where('user_id', auth()->user()->id)->first();
                $reply = $article->replies->where('user_id', auth()->user()->id)->first();
            @endphp
            <a href="{{ url("/comments/view/$article->id") }}"
                class="d-flex align-items-center gap-1 text-decoration-none text-dark">
                @if ($comment || $reply)
                    <i class="bi bi-chat-dots-fill text-success fs-4"></i>
                @else
                    <i class="bi bi-chat-dots text-success fs-4"></i>
                @endif
                @if (count($article->comments) >= 1)
                    <b>{{ $article->comments->count() + $article->replies->count() }}</b>
                @endif
            </a>
        </div>
    </div>
@endauth
