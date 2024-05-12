@extends('layouts/app')
@section('content')
    <div class="container mt-4" style="max-width: 800px">
        @if ($errors->any())
            <div class="alert alert-warning">
                <ol>
                    @foreach ($errors->all() as $error)    
                        <li>{{ $error }}</li>
                    @endforeach
                </ol>
            </div>
        @endif
        @if (session('warning'))
            <div class="alert alert-warning">
                {{ session('warning') }}
            </div>
        @endif
        <div class="mb-3">
            <h4 class="h3 text-info">Edit Page</h4>
        </div>
        <form method="post">
            @csrf
            <div class="mb-3">
                <label for="title" class="text-info">Title</label>
                <input type="text" class="form-control border border-info" name="title" value="{{ $article->title }}">
            </div>
            <div class="mb-3">
                <label for="body" class="text-info">Body</label>
                <textarea type="text" class="form-control border border-info" name="body">{{ $article->body }}</textarea>
            </div>
            <div class="mb-3">
                <label for="category" class="text-info">Category</label>
                <select name="category_id" class="form-select text-info border border-info">
                    @foreach ($categories as $category)
                    @php
                        $selected = $category->id == $article->category_id ? "selected" : "";  
                    @endphp
                        <option value="{{ $category->id }}" {{ $selected }}>
                            {{ $category->name }}
                        </option>
                     @endforeach
                </select>
            </div>
            <a href="{{ url("/articles/detail/$article->id") }}" class="btn btn-secondary ml-3">
                <i class="bi bi-arrow-left"></i>
            </a>
            <input type="submit" value="Update Article" class="btn btn-info text-white">
        </form>
    </div>
@endsection