@extends('layouts.app')
@section('content')
    <div class="container mt-5" style="max-width: 700px">
        @include('shared.alerts')
        <div class="mb-3">
            <h4 class="h3 text-dark">Upload Cover Photo</h4>
        </div>
        <form action="{{ url('/users/profile/upload-cover/' . $user->id) }}" method="POST"  enctype="multipart/form-data">
            @csrf
            <label for="cover">Cover Photo</label>
            <input type="file" name="cover_image" class="form-control mb-3">

            <a href="{{ url("/users/profile/indicate/$user->id") }}" class="btn btn-secondary ml-3">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <button class="btn btn-primary" type="submit">Upload</button>
        </form>
        
    </div>
@endsection
