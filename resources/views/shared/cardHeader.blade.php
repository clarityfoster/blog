
<div class="d-flex justify-content-between">
    <div class="d-flex align-items-center gap-2">
        <a href="#" class="text-decoration-none">
            <b class="h4 rounded-circle text-white d-flex justify-content-center align-items-center" style="width: 55px; height: 55px; background-color: 
            {{ $color }};">
                {{ substr($article->user->name, 0, 1) }}
            </b>
        </a>
        <div class="d-flex flex-column">
            <a href="#" class="text-decoration-none">
                <b class="h5 text-muted mt-2">{{ $article->user->name }}</b>
            </a>
            <span class="text-success small">{{ $article->created_at->diffForHumans() }}</span>
        </div>
    </div>
    <div class="d-flex flex-column align-items-end">
        <span class="text-muted small">Category</span>
        <b class="text-info">{{ $article->category->name }}</b>
    </div>
</div>