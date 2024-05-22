@extends('layouts.app')
@section('content')
    <div class="container" style="max-width: 700px">
        @if ($user->isEmpty() && $articles->isEmpty())
            <ul class="list-group text-center m-auto" style="max-width: 500px">
                <li class="h5 p-3 list-group-item bg-secondary text-light mt-5">
                    <i class="bi bi-exclamation-triangle-fill text-warning me-1"></i>
                    Couldn't find result for "{{ $query }}"
                </li>
            </ul>
        @else
            <ul class="list-group my-3">
                <li class="h5 list-group-item active p-3">Searching result for " {{ $query }} "</li>
                @foreach ($user as $users)
                    @php
                        $colors = [
                            '#FF5733',
                            '#2E9944',
                            '#3357FF',
                            '#F1C40F',
                            '#9B59B6',
                            '#E67E22',
                            '#1ABC9C',
                            '#E74C3C',
                            '#3498DB',
                            '#2ECC71',
                            '#F39C12',
                            '#D35400',
                            '#8E44AD',
                            '#E74C3C',
                            '#9B59B6',
                        ];
                        $colorIndex = $users->id % count($colors);
                        $color = $colors[$colorIndex];
                    @endphp
                    <a href="{{ url("/users/profile/$users->id") }}"
                        class="list-group-item d-flex align-items-center gap-2 mb-1">
                        <b class="h4 rounded-circle text-white d-flex justify-content-center        align-items-center"
                            style="width: 42px; height: 42px; background-color: 
                {{ $color }};">
                            {{ substr($users->name, 0, 1) }}
                        </b>
                        <b class="h5 mb-2">{{ $users->name }}</b>
                    </a>
                @endforeach
            </ul>
            @include('cards.cards')
        @endif
@endsection
