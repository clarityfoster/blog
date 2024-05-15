@extends('layouts/app')
@section('content')
    <div class="container m-auto" style="max-width: 700px"> 
        @include('shared.alerts')
        <div class="d-flex flex-column w-md-100 m-auto">
            <img src="{{ asset("assests/img/feed1.svg") }}" alt="Comment Image" class="mb-4 w-sm-100 mw-100">
            <div class="w-sm-100">
                <a href="{{ url("/articles/detail/$article->id") }}" class="btn btn-primary mb-2">
                    See Article 
                    <i class="bi bi-arrow-up"></i>
                </a>
                @include('shared.comments')
            </div>
        </div>
    </div>
@endsection