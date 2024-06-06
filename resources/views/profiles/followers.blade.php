@extends('layouts.app')
@section('content')
    <div class="container m-auto" style="max-width: 600px">
        @if (count($user->followers) == 0)
        <ul class="list-group text-center m-auto" style="max-width: 500px">
            <li class="h5 p-3 list-group-item bg-secondary text-light mt-5">
                <i class="bi bi-exclamation-triangle-fill text-warning me-1"></i>
                {{ $user->name }} doesn't have any followers yet.
            </li>
        </ul>
        @include('shared.back-btn')
        @else
            <ul class="list-group">
                <li class="h5 list-group-item active">
                    <b>
                        {{ $user->name }}'s 
                        @if (count($user->followers) <= 1)
                            Follower
                        @else 
                            Followers
                        @endif
                    </b>
                    <span class="badge rounded-pill text-bg-light float-end text-primary">
                        {{ count($user->followers) }}
                    </span>
                </li>
                @foreach ($user->followers as $follower)
                    <li class="list-group-item">
                        @include('profiles.follower-profile')
                    </li>
                @endforeach
            </ul>
            @include('shared.back-btn')
        @endif
    </div>
@endsection
