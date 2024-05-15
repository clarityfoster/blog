@foreach ($articles as $article)
{{ $articles->links('pagination::bootstrap-4') }}
<div class="card p-1 mb-3">
    <div class="card-body">
        @php
            $colors = ['#FF5733', '#2E9944', '#3357FF', '#F1C40F', '#9B59B6', '#E67E22'];
            $colorIndex = $article->user->id % count($colors);
            $color = $colors[$colorIndex];
        @endphp
        @include('shared.cardHeader')
        <h5 class="card-title mt-2">{{ $article->title }}</h5>
        <p class="card-text">{{ $article->body }}</p> 
        @include('shared.reactBtn')
        <a href="{{ url("/articles/detail/$article->id") }}" class="text-decoration-none">
            Detail <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>
@endforeach