<h5 class="card-title mt-2">{{ $article->title }}</h5>
@php
    $previewLength = 200;
    $longText = strlen($article->body) > $previewLength;
    $previewText = $longText ? substr($article->body, 0, $previewLength) . '...' : $article->body;
@endphp

<p class="card-text">
    <span class="previewText card-text">{!! nl2br(e($previewText)) !!}</span>
    @if ($longText)
        <span class="fullBody card-text" style="display: none">{!! nl2br(e($article->body)) !!}</span>
        <a href="#" class="seeMore text-muted text-decoration-none">See more</a>
        <a href="#" class="seeLess text-muted text-decoration-none" style="display: none">See less</a>
    @endif
</p>
@php
    $images = json_decode($article->article_image, true);
@endphp
@if (is_array($images))
    <div class="d-flex flex-wrap">
        @foreach ($images as $index => $image)
            <a href="{{ url("/articles/article-photo/$article->id/$index") }}" class="position-relative m-2">
                <img src="{{ asset('storage/' . $image) }}" alt="Article's Image"
                    class="border border-secondary-subtle rounded object-fit-cover"
                    style="width: 190px; height: 190px;">
            </a>
        @endforeach
    </div>
@endif
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
    });
</script>

