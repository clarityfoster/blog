@extends('layouts/app')
@section('content')
    <div class="container" style="max-width: 800px">
        @include('shared.alerts')
        @include('forms.add-form')
    </div>
@endsection