@extends('layouts.app')
@section('content')
    <div class="container" style="max-width: 500px">
        <div class="card p-1">
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
                    <b class="h1 rounded-circle text-white d-flex justify-content-center align-items-center"
                        style="width: 100px; height: 100px; background-color: 
                    {{ $color }};">
                        {{ substr($user->name, 0, 1) }}
                    </b>
                    <b class="h4 text-dark mt-2">{{ $user->name }}</b>
                    <p class="text-success text-center">
                        {{ $user->bio }}
                    </p>
                    <div class="d-flex flex-column text-muted my-2">
                        <p class="mb-1">
                            <i class="bi bi-envelope-fill me-2"></i>
                            <b class="text-lowercase">{{ $user->email }}</b>
                        </p>
                        <p class="mb-1">
                            <i class="bi bi-hearts me-2"></i>
                            <b>
                                {{$user->rs_status}}
                            </b>
                        </p>
                        <p class="mb-1">
                            <i class="bi bi-clock-fill me-2"></i>
                            <b class="">
                                Joined at {{ $user->created_at->diffForHumans() }}
                            </b>
                        </p>
                        <p>
                            <i class="bi bi-rss-fill me-2"></i>
                            <b class="">
                                {{ $user->followers }} Followers
                            </b>
                        </p>
                    </div>
                    <div class="d-flex gap-2">
                        <a href="#" class="btn btn-primary fs-5 mb-3">
                            <i class="bi bi-pencil-square me-1"></i>
                            Edit Profile
                        </a>
                        <a href="#" class="btn btn-danger fs-5 mb-3">
                            <i class="bi bi-slash-circle-fill me-1"></i>
                            Block
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
