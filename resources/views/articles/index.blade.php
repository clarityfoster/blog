@extends('layouts/app')
@section('content')
    <div class="container m-auto px-3" id="container" style="max-width: 700px">
        @include('shared.alerts')
        @include('cards.cards')
        {{ $articles->links() }}
    </div>
@endsection
