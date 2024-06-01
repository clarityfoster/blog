@extends('layouts/app')
@section('content')
    <div class="container m-auto" style="max-width: 700px"> 
        @include('shared.alerts')
        <div class="w-sm-100 mt-2">
            @include('shared.see-article')
            @include('comments.comments')
        </div>
    </div>
@endsection