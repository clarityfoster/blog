<div class="d-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center gap-3">
        <a href="{{ url("/users/profile/".$like->user->id) }}" class="text-decoration-none">
            @php
                $colors = [
                    '#FF5733', '#2E9944', '#3357FF', '#F1C40F', '#9B59B6', '#E67E22', '#1ABC9C', '#E74C3C', '#3498DB', '#2ECC71', '#F39C12', '#D35400', '#8E44AD', '#E74C3C',  '#9B59B6',
                ];
                $colorIndex = $like->user->id % count($colors);
                $color = $colors[$colorIndex];
            @endphp
            <b class="h4 rounded-circle text-white d-flex justify-content-center align-items-center" style="width: 42px; height: 42px; background-color: 
            {{ $color }};">
                {{ substr($like->user->name, 0, 1) }}
            </b>
        </a>
        <div class="d-flex flex-column">
            <a href="{{ url("/users/profile/".$like->user->id) }}" class="text-decoration-none mb-2">
                <b class="h6 text-muted">{{ $like->user->name }}</b>
            </a>
        </div>
    </div>
    <small class="small text-success mt-1">
        <i class="bi bi-clock"></i>
        {{ $like->created_at->diffForHumans() }}
    </small>
</div>