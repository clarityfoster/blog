@extends('layouts.app')
@section('content')
    <div class="container mt-5" style="max-width: 700px">
        @include('shared.alerts')
        <div class="mb-3">
            <h4 class="h3 text-info">Upload Cover Photo</h4>
        </div>
        <form action="{{ url('/users/profile/upload-cover/' . $user->id) }}" method="POST"  enctype="multipart/form-data">
            @csrf
            <label for="cover_caption">Cover Caption</label>
            <input type="text" class="form-control mb-3" name="cover_caption" value="{{ $user->cover_caption }}">
            <label for="cover">Cover Photo</label>
            <input type="file" name="cover_image" class="form-control mb-3">

            @include('shared.back-btn')
            <button class="btn btn-info text-white" type="submit">Upload</button>
        </form>
        
    </div>
@endsection
