@extends('layouts.app')
@section('content')
<div class="container mt-5" style="max-width: 700px">
    @include('shared.alerts')
    <div class="mb-3">
        <h4 class="h3 text-dark">Upload Profile Image</h4>
    </div>
    <form action="{{ url("/users/profile/upload-profile/$user->id") }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <input type="file" class="form-control" name="image" id="inputGroupFile04">
        </div>
        <button class="btn btn-outline-secondary" type="submit">Upload</button>
    </form>
</div>
@endsection
