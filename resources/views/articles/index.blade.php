@extends('layouts/app')
@section('content')
    <div class="container m-auto px-3" style="max-width: 700px">
        @include('shared.alerts')
        {{ $articles->links() }}
        @include('cards.cards')
    </div>
@endsection
