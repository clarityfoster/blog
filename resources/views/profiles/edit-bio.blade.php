@extends('layouts.app')
@section('content')
    <div class="container mt-5" style="max-width: 700px">
        @include('shared.alerts')
        <div class="mb-3">
            <h4 class="h3 text-info">Bio Edit Page</h4>
        </div>
        <form action="{{ url("/users/profile/edit-bio/".$user->id) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="bio">Bio</label>
                <input name="bio" type="text" class="form-control" value="{{ $user->bio }}">
            </div>
            <a href="{{ url("/users/profile/$user->id") }}" class="btn btn-secondary ml-3">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <input type="submit" value="Update" class="btn btn-info text-white">
        </form>
    </div>
@endsection