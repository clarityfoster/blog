
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
            @php
                $colors = [
                    '#FF5733', '#33FF57', '#3357FF', '#F1C40F', '#9B59B6', '#E67E22', '#1ABC9C', '#E74C3C', '#3498DB', '#2ECC71', '#F39C12', '#D35400', '#8E44AD', '#E74C3C',  '#9B59B6' 
                ];
                $colorIndex = $comment->user->id % count($colors);
                $color = $colors[$colorIndex];
            @endphp
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-start gap-3">
                    <a href="#" class="text-decoration-none">
                        <b class="h4 rounded-circle text-white d-flex justify-content-center align-items-center" style="width: 42px; height: 42px; background-color: 
                        {{ $color }};">
                            {{ substr($comment->user->name, 0, 1) }}
                        </b>
                    </a>
                    <div class="d-flex flex-column">
                        <a href="#" class="text-decoration-none mb-2">
                            <b class="h6 text-muted">{{ $comment->user->name }}</b>
                        </a>
                        <span class="">{{ $comment->content }}</span>
                    </div>
                </div>
                @auth 
                    @can('comment-delete', $comment)
                        <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                    @endcan
                @endauth
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