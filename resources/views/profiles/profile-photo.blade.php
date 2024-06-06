@extends('layouts.app')
@section('content')
    <div class="container mt-5" style="max-width: 450px">
        <div class="card position-relative">
            <img src="{{ asset('storage/' . $user->image) }}" alt="{{ $user->name }}" class="card-img-top  object-fit-cover">
            <a href="#" class="btn btn-secondary position-absolute" style="transform: translate(50%, 50%)">
                <i class="bi bi-download"></i>
            </a>
            <div class="card-body">
                <p class="h5 card-title">{{ $user->name }}</p>
                @include('shared.back-btn')
            </div>
        </div>
    @endsection
