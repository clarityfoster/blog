@extends('layouts.app')
@section('content')
    @php
        $follow = $user->followers->where('current_user_id', auth()->user()->id)->first();
    @endphp
    <div class="container" style="max-width: 500px">
        @include('shared.alerts')
        <div class="card p-1 mb-3">
            <div class="card-body">
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
                    $colorIndex = $user->id % count($colors);
                    $color = $colors[$colorIndex];
                @endphp
                <div class="d-flex flex-column justify-content-center align-items-center mt-4">
                    @include('profiles.profile-circle')
                    <b class="h3 text-dark mt-2">{{ $user->name }}</b>
                    <p class="text-success text-center">
                        {{ $user->bio }}
                        @auth
                            @can('edit-rs', $user)
                                <a href="{{ url("/users/profile/edit-bio/$user->id") }}" class="text-decoration-none text-muted ms-2">
                                    <i class="bi bi-pencil-square me-1"></i>
                                </a>
                            @endcan
                        @endauth
                    </p>
                    <div class="d-flex flex-column text-dark fs-5 my-2">
                        <p class="mb-1">
                            <i class="bi bi-envelope-fill text-info fs-4 me-3"></i>
                            <b class="text-lowercase">{{ $user->email }}</b>
                        </p>
                        <p class="mb-1">
                            <i class="bi bi-hearts text-danger fs-4 me-3"></i>
                            <b class="me-3">
                                @if ($user->relationship)
                                    {{ $user->relationship->name }}
                                @else
                                    <b class="text-muted">Hidden</b>
                                @endif
                            </b>
                            @auth
                                @can('edit-bio', $user)
                                    <a href="{{ url("/users/profile/edit/$user->id") }}"
                                        class="text-decoration-none text-muted small">
                                        <i class="bi bi-pencil-square me-1"></i>
                                    </a>
                                @endcan
                            @endauth
                        </p>
                        <p class="mb-1">
                            <i class="bi bi-clock-fill fs-4 text-success me-3"></i>
                            <b class="">
                                Joined at {{ $user->created_at->diffForHumans() }}
                            </b>
                        </p>
                        <p class="mb-1">
                            <i class="bi bi-rss-fill fs-4 text-secondary me-3"></i>
                            <a href="{{ url("/users/profile/followers/$user->id") }}"
                                class="text-decoration-none text-dark">
                                <b>{{ count($user->followers) }}
                                    @if (count($user->followers) <= 1)
                                        Follower
                                    @else
                                        Followers
                                    @endif
                                </b>
                            </a>
                        </p>
                        <p>
                            <i class="bi bi-check-square-fill fs-4 text-secondary me-3"></i>
                            <a href="{{ url("/users/profile/following/$user->id") }}"
                                class="text-decoration-none text-dark">
                                <b>{{ count($user->following) }}
                                    @if (count($user->following) <= 1)
                                        Following
                                    @else
                                        Followings
                                    @endif
                                </b>
                            </a>
                        </p>
                    </div>
                    @if (auth()->user()->id !== $user->id)
                        <div class="d-flex gap-2">
                            @if ($follow)
                                <form action="{{ url("/users/profile/unfollow/$user->id") }}" method="post">
                                    @csrf
                                    <button class="btn btn-success fs-5">
                                        <i class="bi bi-check-circle-fill me-1"></i>
                                        Following
                                    </button>
                                </form>
                            @else
                                <form action="{{ url("/users/profile/follow/$user->id") }}" method="post">
                                    @csrf
                                    <button class="btn btn-primary fs-5">
                                        <i class="bi bi-plus-circle-fill me-1"></i>
                                        Follow
                                    </button>
                                </form>
                            @endif
                            <button class="btn btn-danger fs-5" style="max-height: 42px">
                                <i class="bi bi-slash-circle-fill me-1"></i>
                                Block
                            </button>
                        </div>
                    @endif
                    @if ($follow)
                        <button id="show-post" class="btn btn-outline-secondary">{{ $user->name }}'s Posts</button>
                    @endif
                </div>
            </div>
        </div>

        <div id="user-articles" style="display: none">
            @foreach ($user->articles as $article)
                @include('cards.card')
            @endforeach
        </div>
    </div>
@endsection

<script>
    addEventListener("DOMContentLoaded", function() {
        const showPost = document.getElementById("show-post");
        const articlesDiv = document.getElementById("user-articles");

        showPost.addEventListener("click", function() {
            if (articlesDiv.style.display === "none") {
                articlesDiv.style.display = "block";
            } else {
                articlesDiv.style.display = "none";
            }
        });
    });
</script>
