@extends('layouts.app')
@section('content')
    <div class="container m-auto" style="max-width: 600px">
        @if (count($user->followers) == 0)
            <div class="alert alert-dark text-center m-auto mt-5" style="max-width: 450px">
                <p class="h5 m-0">{{ $user->name }} doesn't have any followers yet.</p>
            </div>
        @else
            <ul class="list-group">
                <li class="h5 list-group-item active">
                    <b>{{ $user->name }}'s Followers</b>
                    <span class="badge rounded-pill text-bg-light float-end text-primary">
                        {{ count($user->followers) }}
                    </span>
                </li>
                @foreach ($user->followers as $follower)
                    <li class="list-group-item">
                        @include('profiles.followerProfile')
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
