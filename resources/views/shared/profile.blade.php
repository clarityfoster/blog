<a href="#" class="text-decoration-none">
    @php
        $colors = [
            '#FF5733', '#2E9944', '#3357FF', '#F1C40F', '#9B59B6', '#E67E22', '#1ABC9C', '#E74C3C', '#3498DB', '#2ECC71', '#F39C12', '#D35400', '#8E44AD', '#E74C3C',  '#9B59B6',
        ];
        $colorIndex = $article->user->id % count($colors);
        $color = $colors[$colorIndex];
    @endphp
    <b class="h4 rounded-circle text-white d-flex justify-content-center align-items-center" style="width: 55px; height: 55px; background-color: 
    {{ $color }};">
        {{ substr($article->user->name, 0, 1) }}
    </b>
</a>