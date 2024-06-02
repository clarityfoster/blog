@extends('layouts/app')
@section('content')
    <div class="container d-flex flex-column align-items-center mt-5" style="max-width: 500px">
        <a href="{{ url("/users/profile/upload-cover/$user->id") }}" class="btn btn-info text-white w-100 my-2">Upload Cover Photo</a>
        <b class="text-align">OR</b>
        <a href="{{ url("/users/profile/upload-profile/$user->id") }}" class="btn btn-success w-100 my-2">Upload Profile Photo</a>
        @include('shared.back-btn')
    </div>
@endsection