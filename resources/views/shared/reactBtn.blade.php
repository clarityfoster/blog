     
@auth
    <div class="d-flex justify-content-between mb-2">
        <div>
            {{-- Heart Icon --}}
            <form action="{{ url("article.like") }}"  method="posst">
                @csrf
                <button type="submit" class="btn btn-link p-0">
                    <i class="bi bi-heart-fill fs-4 text-danger"></i>
                </button>
                <a href="#" class="text-decoration-none text-dark">
                    <b></b>
                </a>
            </form>
        </div> 
        <div>
            @if (count($article->comments) <= 0)
                <a href="{{ url("/comments/view/$article->id") }}" class="text-decoration-none text-dark">
                    <i class="bi bi-chat-dots fs-4"></i>
                </a>
            @else
                <a href="{{ url("/comments/view/$article->id") }}" class="text-decoration-none text-dark">
                    <i class="bi bi-chat-dots fs-4"></i>
                    <b>{{ count($article->comments) }}</b>
                </a>
            @endif
        </div> 
    </div>
@endauth 