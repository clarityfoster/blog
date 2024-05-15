<div class="card p-1 mb-2">
    <div class="card-body">
        @php
            $colors = [
                '#FF5733', '#33FF57', '#3357FF', '#F1C40F', '#9B59B6', '#E67E22', '#1ABC9C', '#E74C3C', '#3498DB', '#2ECC71', '#F39C12', '#D35400', '#8E44AD', '#E74C3C',  '#9B59B6' 
            ];
            $colorIndex = $article->user->id % count($colors);
            $color = $colors[$colorIndex];
        @endphp
        @include('shared.cardHeader')
        <h5 class="card-title mt-2">{{ $article->title }}</h5>
        <p class="card-text">{{ $article->body }}</p>   
        @auth
             <div class="d-flex justify-content-between mb-2">
                 <div>
                     {{-- Heart Icon --}}
                     <a href="#" class="text-dark">
                         <i class="bi bi-heart fs-5"></i>
                     </a>
                     {{-- Number of reacts --}}
                     <a href="" class="text-decoration-none text-dark">
                         
                     </a>
                 </div> 
                 <div>
                     <i class="bi bi-hand-thumbs-down fs-5"></i>
                     <a href="" class="text-decoration-none text-dark">
                         
                     </a>
                 </div> 
                 <div>
                     @if (count($article->comments) <= 0)
                        <i class="bi bi-chat-dots fs-5"></i>
                     @else
                        <i class="bi bi-chat-dots fs-5"></i>
                        {{ count($article->comments) }}
                     @endif
                 </div> 
             </div>
        @endauth 
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