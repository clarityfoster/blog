<div class="container" style="max-width: 600px">
    @include('shared.seeArticle')
    <ul class="list-group">
        <li class="list-group-item active">
            <b class="fs-5">
                @if ( count($article->likes) <= 1 )
                    Like
                @else
                    Likes
                @endif
                <span class="badge rounded-pill text-bg-light float-end text-primary">
                    {{ count($article->likes) }}
                </span>
            </b>
            @foreach ($article->likes as $like) 
                <li class="list-group-item">
                    @include('shared.reactProfile')
                </li>
            @endforeach
        </li>
    </ul>
</div>