<div class="d-flex align-items-center justify-content-between">
    <a href="{{ url('/users/profile/' . $like->user->id) }}" class="text-decoration-none d-flex align-items-center gap-2">
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
            $colorIndex = $like->user->id % count($colors);
            $color = $colors[$colorIndex];
        @endphp
        @if ($like->user->image)
            <img src="{{ asset('storage/' . $like->user->image) }}" alt="{{ $like->user->name }}"
                class="rounded-circle text-white d-flex justify-content-center align-items-center object-fit-cover"
                style="width: 55px; height: 55px;">
        @else
            <b class="h4 rounded-circle text-white d-flex justify-content-center align-items-center"
                style="width: 55px; height: 55px; background-color: 
            {{ $color }};">
                {{ substr($like->user->name, 0, 1) }}
            </b> 
        @endif
        <b class="h5 text-dark">{{ $like->user->name }}</b>
    </a>
    <small class="small text-success mt-1">
        <i class="bi bi-clock"></i>
        {{ $like->created_at->diffForHumans() }}
    </small>
</div>
