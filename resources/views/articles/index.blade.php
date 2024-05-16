@extends('layouts/app')
@section('content')
    <div class="container m-auto px-3" style="max-width: 700px">
        @include('shared.alerts')
        @include('cards.cards')
    </div>
@endsection
