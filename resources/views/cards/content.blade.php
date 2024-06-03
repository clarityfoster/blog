<h5 class="card-title mt-2">{{ $article->title }}</h5>
<p class="card-text">{{ $article->body }}</p>
@php
    $images = json_decode($article->article_image, true);
@endphp
@if (is_array($images))
    @foreach ($images as $image)
        <img src="{{ asset('storage/' . $image) }}" alt="Article's Image" class="rounded object-fit-cover mb-2 me-1"
            style="width: 199px; height: 199px">
    @endforeach
@endif
