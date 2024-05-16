@extends('layouts/app')
@section('content')
    <div class="container mt-4" style="max-width: 800px">
       @include('shared.alerts')
        @include('forms.editForm')
    </div>
@endsection