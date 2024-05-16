@extends('layouts/app')
@section('content')
    <div class="cotainer m-auto px-3" style="max-width: 700px">
        @include('shared.alerts')
        @include('cards.card')
        @include('shared.comments')
    </div>
@endsection