@extends('layouts.app')
@section('content')
    <div class="container mt-5" style="max-width: 700px">
        @include('shared.alerts')
        <div class="mb-3">
            <h4 class="h3 text-success">Upload Profile Image</h4>
        </div>
        <form action="{{ url('/users/profile/upload-profile/' . $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label for="profile">Profile Photo</label>
            <input type="file" name="image" class="form-control mb-3">

            @include('shared.back-btn')
            <button class="btn btn-success" type="submit">Upload</button>
        </form>
        
    </div>
@endsection
