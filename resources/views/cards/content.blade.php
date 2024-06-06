<h5 class="card-title mt-2">{{ $article->title }}</h5>
<p class="card-text">{{ $article->body }}</p>

@php
    $images = json_decode($article->article_image, true);
@endphp

@if (is_array($images))
    <div class="d-flex flex-wrap">
        @foreach ($images as $index => $image )
            <a href="{{ url("/articles/article-photo/$article->id/$index") }}" class="position-relative m-2">
                <img src="{{ asset('storage/' . $image) }}" alt="Article's Image" class="rounded object-fit-cover"
                    style="width: 190px; height: 190px;">
            </a>
        @endforeach
    </div>
@endif
