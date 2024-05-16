@extends('layouts/app')
@section('content')
    <div class="container m-auto" style="max-width: 700px"> 
        @include('shared.alerts')
        <div class="w-sm-100">
            @include('shared.seeArticle')
            @include('shared.comments')
        </div>
    </div>
@endsection