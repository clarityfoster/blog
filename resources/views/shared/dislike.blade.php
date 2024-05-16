<div class="container" style="max-width: 600px">
    <ul class="list-group">
        <li class="list-group-item active">
            <b class="fs-5">
                @if ( count($article->dislikes) <= 1 )
                    Dislike
                @else
                    Dislikes
                @endif
                ({{ count($article->dislikes) }})
            </b>
            @foreach ($article->dislikes as $dislike) 
                <li class="list-group-item">
                    @include('shared.dislikeProfile')
                </li>
            @endforeach
        </li>
    </ul>
</div>