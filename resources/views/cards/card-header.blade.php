<div class="d-flex justify-content-between">
    <div class="d-flex align-items-center gap-2">
        @include('shared.profile')
        <div class="d-flex flex-column">
            <a href="{{ url('/users/profile/' . $article->user->id) }}" class="text-decoration-none">
                <b class="h5 text-muted mt-2">{{ $article->user->name }}</b>
            </a>
            <div class="d-flex text-muted align-items-center gap-2 small">
                <span>{{ $article->created_at->diffForHumans() }}</span>
                <i class="{{ $article->privacy->icons }}"></i>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column align-items-end">
        <span class="text-muted small">Category</span>
        <b class="text-info">{{ $article->category->name }}</b>
    </div>
</div>
