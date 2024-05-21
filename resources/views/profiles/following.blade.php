@extends('layouts.app')
@section('content')
    <div class="container m-auto" style="max-width: 600px">
        @if (count($user->following) == 0)
            <div class="alert alert-dark text-center m-auto mt-5" style="max-width: 450px">
                <p class="h5 m-0">{{ $user->name }} doesn't have any followings yet.</p>
            </div>
        @else
            <ul class="list-group">
                <li class="h5 list-group-item active">
                    <b>{{ $user->name }}'s Following</b>
                    <span class="badge rounded-pill text-bg-light float-end text-primary">
                        {{ count($user->following) }}
                    </span>
                </li>
                @foreach ($user->following as $following)
                    <li class="list-group-item">
                        @include('profiles.followingProfile')
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection