<ul class="list-group mb-2">
    <li class="list-group-item active">
        <b class="h5">
            @if (count($article->comments) <= 1)
                Comment
            @else
                Comments
            @endif
            <span class="badge rounded-pill text-bg-light float-end text-primary">
                {{ $article->comments->count() + $article->replies->count() }}
            </span>
        </b>
    </li>
    @foreach ($article->comments as $comment)
        <li class="list-group-item">
            @php
                $colors = [
                    '#FF5733',
                    '#2E9944',
                    '#3357FF',
                    '#F1C40F',
                    '#9B59B6',
                    '#E67E22',
                    '#1ABC9C',
                    '#E74C3C',
                    '#3498DB',
                    '#2ECC71',
                    '#F39C12',
                    '#D35400',
                    '#8E44AD',
                    '#E74C3C',
                    '#9B59B6',
                ];
                $colorIndex = $comment->user->id % count($colors);
                $color = $colors[$colorIndex];
            @endphp
            <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-start gap-3">
                    <a href="{{ url('/users/profile/' . $comment->user->id) }}" class="text-decoration-none">
                        @if ($comment->user->image)
                            <img src="{{ asset('storage/' . $comment->user->image) }}" alt="{{ $comment->user->name }}"
                                class="rounded-circle text-white d-flex justify-content-center align-items-center object-fit-cover"
                                style="width: 50px; height: 50px;">
                        @else
                            <b class="h4 rounded-circle text-white d-flex justify-content-center align-items-center"
                                style="width: 50px; height: 50px; background-color: 
                                {{ $color }};">
                                {{ substr($comment->user->name, 0, 1) }}
                            </b>
                        @endif
                    </a>
                    <div class="d-flex flex-column justify-content-center">
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{ url('/users/profile/' . $comment->user->id) }}" class="text-decoration-none">
                                <b class="h6 text-muted">{{ $comment->user->name }}</b>
                            </a>
                            <small class="small text-success">
                                {{ $comment->created_at->diffForHumans() }}
                            </small>
                        </div>
                        @php
                            $previewLength = 145;
                            $longText = strlen($comment->content) > $previewLength;
                            $previewText = $longText
                                ? substr($comment->content, 0, $previewLength) . '...'
                                : $comment->content;
                        @endphp
                        <span class="previewText">{!! nl2br(e($previewText)) !!}</span>
                        @if ($longText)
                            <span class="fullBody" style="display: none">{!! nl2br(e($comment->content)) !!}</span>
                            <a href="#" class="seeMore small text-muted text-decoration-none">See more</a>
                            <a href="#" class="seeLess small text-muted text-decoration-none"
                                style="display: none">See less</a>
                        @endif
                        <a href="" class="reply card-link text-decoration-none small text-muted"
                            data-user="{{ $comment->user->name }}">
                            Reply
                        </a>

                        <div class="row my-2" style="display: none">
                            <form method="POST" action="{{ url('/comments/reply') }}">
                                @csrf
                                <textarea name="replies" type="text" class="form-control border-0 border-bottom shadow-none"
                                    placeholder="Reply to this comment"></textarea>
                                <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                <input type="hidden" name="article_id" value="{{ $article->id }}">
                                <div class="d-flex gap-2 mt-2 justify-content-end">
                                    <button class="cancelBtn btn btn-secondary btn-sm">Cancel</button>
                                    <button type="submit" class="btn btn-primary btn-sm">Reply</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @auth
                    @can('comment-delete', $comment)
                        <a href="{{ url("/comments/delete/$comment->id") }}" class="btn-close float-end"></a>
                    @endcan
                @endauth
            </div>
            <ul class="list-group list-group-flush ms-5 mt-2">
                @foreach ($comment->replies as $reply)
                    @php
                        $colors = [
                            '#FF5733',
                            '#2E9944',
                            '#3357FF',
                            '#F1C40F',
                            '#9B59B6',
                            '#E67E22',
                            '#1ABC9C',
                            '#E74C3C',
                            '#3498DB',
                            '#2ECC71',
                            '#F39C12',
                            '#D35400',
                            '#8E44AD',
                            '#E74C3C',
                            '#9B59B6',
                        ];
                        $colorIndex = $reply->user->id % count($colors);
                        $color = $colors[$colorIndex];
                    @endphp
                    <li class="list-group-item">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-start gap-3">
                                <a href="{{ url('/users/profile/' . $reply->user->id) }}" class="text-decoration-none">
                                    @if ($reply->user->image)
                                        <img src="{{ asset('storage/' . $reply->user->image) }}"
                                            alt="{{ $reply->user->name }}"
                                            class="rounded-circle text-white d-flex justify-content-center align-items-center object-fit-cover"
                                            style="width: 40px; height: 40px;">
                                    @else
                                        <b class="h5 rounded-circle text-white d-flex justify-content-center align-items-center"
                                            style="width: 40px; height: 40px; background-color: {{ $color }};">
                                            {{ substr($reply->user->name, 0, 1) }}
                                        </b>
                                    @endif
                                </a>
                                <div class="d-flex flex-column justify-content-center">
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="{{ url('/users/profile/' . $reply->user->id) }}"
                                            class="text-decoration-none">
                                            <b class="h6 text-muted">{{ $reply->user->name }}</b>
                                        </a>
                                        <small class="small text-success">
                                            {{ $reply->created_at->diffForHumans() }}
                                        </small>
                                    </div>
                                    <span>{{ $reply->replies }}</span>
                                    <a href="#" class="reply card-link text-decoration-none small text-muted"
                                        data-user="{{ $reply->user->name }}">
                                        Reply
                                    </a>
                                    <div class="row my-2 reply-form" style="display: none">
                                        <form method="POST" action="{{ url('/comments/reply') }}">
                                            @csrf
                                            <textarea name="replies" type="text" class="form-control border-0 border-bottom shadow-none"
                                                placeholder="Reply to this comment"></textarea>
                                            <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                                            <div class="d-flex gap-2 mt-2 justify-content-end">
                                                <button class="cancelBtn btn btn-secondary btn-sm">Cancel</button>
                                                <button type="submit" class="btn btn-primary btn-sm">Reply</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @auth
                                @can('reply-del', $reply)
                                    <a href="{{ url("/comments/reply/delete/$reply->id") }}" class="btn-close float-end"></a>
                                @endcan
                            @endauth
                        </div>
                    </li>
                @endforeach
            </ul>
        </li>
    @endforeach
</ul>
@auth
    <form action="{{ url('/comments/add') }}" method="POST">
        @csrf
        <input type="hidden" name="article_id" value="{{ $article->id }}">
        <textarea name="content" class="form-control mb-2" placeholder="New Comment"></textarea>
        @include('shared.back-btn')
        <input type="submit" value="Add Comment" class="btn btn-primary">
    </form>
@endauth

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const seeMoreButtons = document.querySelectorAll('.seeMore');
        const seeLessButtons = document.querySelectorAll('.seeLess');
        const previewTexts = document.querySelectorAll('.previewText');
        const fullBodies = document.querySelectorAll('.fullBody');

        seeMoreButtons.forEach((button, index) => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                button.style.display = "none";
                seeLessButtons[index].style.display = "inline";
                previewTexts[index].style.display = "none";
                fullBodies[index].style.display = "inline";
            });
        });

        seeLessButtons.forEach((button, index) => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                button.style.display = "none";
                seeMoreButtons[index].style.display = "inline";
                fullBodies[index].style.display = "none";
                previewTexts[index].style.display = "inline";
            });
        });

        const replyBtn = document.querySelectorAll('.reply');
        const cancelBtn = document.querySelectorAll('.cancelBtn');
        const row = document.querySelectorAll(".row");
        replyBtn.forEach((button, index) => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                button.style.display = "none";
                row[index].style.display = "block";
                const replyText = row[index].querySelector('textarea[name="replies"]');
                const userName = button.getAttribute('data-user');
                replyText.value = `@${userName}`;
                replyText.focus();
            })
        })
        cancelBtn.forEach((button, index) => {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                row[index].style.display = "none";
                replyBtn[index].style.display = "block";
                const replyText = document.querySelector('textarea[name="reply"]');
                replyText.value = "";
            })
        })
    });
</script>
