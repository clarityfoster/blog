<div class="card p-2 mb-2">
    <div class="card-body">
        @php
            $colors = [
                '#FF5733', '#33FF57', '#3357FF', '#F1C40F', '#9B59B6', '#E67E22', '#1ABC9C', '#E74C3C', '#3498DB', '#2ECC71', '#F39C12', '#D35400', '#8E44AD', '#E74C3C',  '#9B59B6' 
            ];
            $colorIndex = $article->user->id % count($colors);
            $color = $colors[$colorIndex];
        @endphp
        @include('cards.card-header')
        @include('cards.content')
        @include('shared.react-btn')
        @auth
           @can('article-delete', $article)
                <a href="{{ url("/articles/delete/$article->id") }}" class="btn btn-danger">Delete</a>
           @endcan
            @can('article-edit', $article)
                <a href="{{ url("/articles/edit/$article->id") }}" class="btn btn-info text-white">Edit</a>
            @endcan
        @endauth
    </div>
</div>