{{ $articles->links('pagination::bootstrap-4') }}
@foreach ($articles as $article)
<div class="card p-2 mb-3">
    <div class="card-body">
        @php
            $colors = [
                '#FF5733', '#2E9944', '#3357FF', '#F1C40F', '#9B59B6', '#E67E22', '#1ABC9C', '#E74C3C', '#3498DB', '#2ECC71', '#F39C12', '#D35400', '#8E44AD', '#E74C3C',  '#9B59B6'
            ];
            $colorIndex = $article->user->id % count($colors);
            $color = $colors[$colorIndex];
        @endphp
        @include('cards.card-header')
        @include('cards.content')
        @include('shared.react-btn')
        <a href="{{ url("/articles/detail/$article->id") }}" class="text-decoration-none">
            Detail <i class="bi bi-arrow-right"></i>
        </a>
    </div>
</div>
@endforeach