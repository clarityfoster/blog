@extends('layouts.app')
@section('content')
    @php
        $follow = $user->followers->where('current_user_id', auth()->user()->id)->first();
    @endphp
    <div class="container" style="max-width: 450px">
        @include('shared.alerts')
        <div class="card mb-3" style="max-height: 650px">
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
                <div>
                    @if ($user->cover_image)
                        <img src="{{ asset('storage/' . $user->cover_image) }}" alt="{{ $user->name }}" class="rounded"
                            style="width: 100%; height: 200px; object-fit: cover;">
                    @else
                        <img src="{{ asset('assests/img/default.jpg') }}" alt="Cover Image" class="rounded"
                            style="width: 100%; height: 200px; object-fit: cover;">
                    @endif
                    <div class="d-flex flex-column align-items-center" style="transform: translate(0%, -20.5%)">
                        @if ($user->image)
                            <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}"
                                class="profile-photo rounded-circle text-white d-flex justify-content-center align-items-center object-fit-cover mb-2"
                                style="width: 180px; height: 180px;">
                        @else
                            @include('profiles.profile-circle')
                        @endif
                        <div class="d-flex gap-2">
                            @can('upload-img', $user)
                                <a href="{{ url("/users/profile/indicate/$user->id") }}"
                                    class="text-decoration-none text-muted small">
                                    <i class="bi bi-pencil-square me-1"></i>
                                </a>
                            @endcan
                        </div>
                        <b class="h3 text-dark mt-2">{{ $user->name }}</b>
                        <p class="text-success text-center">
                            {{ $user->bio }}
                            @auth
                                @can('edit-bio', $user)
                                    <a href="{{ url("/users/profile/edit-bio/$user->id") }}"
                                        class="text-decoration-none text-muted ms-2">
                                        <i class="bi bi-pencil-square me-1"></i>
                                    </a>
                                @endcan
                            @endauth
                        </p>
                        <div class="d-flex flex-column text-dark my-2">
                            <p class="mb-1">
                                <i class="bi bi-envelope-fill text-info me-3"></i>
                                <b class="text-lowercase">{{ $user->email }}</b>
                            </p>
                            <p class="mb-1">
                                <i class="bi bi-hearts text-danger me-3"></i>
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
                                <i class="bi bi-clock-fill text-success me-3"></i>
                                <b class="">
                                    Joined at {{ $user->created_at->diffForHumans() }}
                                </b>
                            </p>
                            <p class="mb-1">
                                <i class="bi bi-rss-fill text-secondary me-3"></i>
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
                                <i class="bi bi-check-square-fill text-secondary me-3"></i>
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
                            <div class="d-flex gap-2 mb-2">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
