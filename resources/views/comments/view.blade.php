@extends('layouts/app')
@section('content')
    <div class="container m-auto" style="max-width: 700px"> 
        @if ($errors->any())
            <div class="alert alert-warning">
                @foreach ($errors->all() as $error)
                    <ol>
                        <li>{{ $error }}</li>
                    </ol>
                @endforeach
            </div>
        @endif
        @if (session('cm-created')) 
            <div class="alert alert-success">
                {{ session('cm-created') }}
            </div>
        @endif
        @if (session('cm-delete')) 
            <div class="alert alert-danger">
                {{ session('cm-delete') }}
            </div>
        @endif
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