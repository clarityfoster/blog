<h5 class="card-title mt-2">{{ $article->title }}</h5>
@php
    $previewLength = 200;
    $longText = strlen($article->body) > $previewLength;
    $previewText = $longText ? substr($article->body, 0, $previewLength) . '...' : $article->body;
@endphp

<p class="card-text">
    <span class="card-text" id="previewText">{!! nl2br(e($previewText)) !!}</span>
    @if ($longText)
        <span class="card-text" id="fullBody" style="display: none">{!! nl2br(e($article->body)) !!}</span>
        <a href="#" id="seeMore" class="text-muted text-decoration-none">See more</a>
        <a href="#" id="seeLess" class="text-muted text-decoration-none" style="display: none">See less</a>
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
        const seeMore = document.getElementById('seeMore');
        const seeLess = document.getElementById('seeLess');
        const previewText = document.getElementById('previewText');
        const fullBody = document.getElementById('fullBody');
        seeMore.addEventListener("click", function() {
            seeMore.style.display = "none";
            seeLess.style.display = "inline";
            previewText.style.display = "none";
            fullBody.style.display = "inline";
        })
        seeLess.addEventListener("click", function() {
            seeMore.style.display = "inline";
            seeLess.style.display = "none";
            previewText.style.display = "inline";
            fullBody.style.display = "none";
        })
        
    })
</script>
