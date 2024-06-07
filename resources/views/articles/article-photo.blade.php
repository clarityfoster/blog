@extends('layouts.app')

@php
    $images = json_decode($article->article_image, true);
@endphp

@section('content')
    <div class="container" style="max-width: 800px">
        <div class="card">
            @if (count($images) > 1)
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        @foreach ($images as $index => $image)
                            <div class="carousel-item {{ $index == $imageIndex ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image) }}" class="d-block w-100 object-fit-cover" alt="Article's Image" style="max-height: 1000px">
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="prev">
                        <span class="btn btn-light rounded-circle" aria-hidden="true">
                            <i class="bi bi-arrow-left"></i>
                        </span>
                        <span class="visually-hidden">Previous</span>
                    </button> 
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                        data-bs-slide="next">
                        <span class="btn btn-light rounded-circle" aria-hidden="true">
                            <i class="bi bi-arrow-right"></i>
                        </span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            @else 
                <img src="{{ asset('storage/' . $image) }}" class="d-block w-100" alt="Article's Image">
            @endif
            <div class="card-body">
                <h5 class="card-title mt-2">{{ $article->title }}</h5>
                <p class="card-text">{{ $article->body }}</p>
                @include('shared.back-btn')
            </div>
        </div>
    </div>
@endsection
