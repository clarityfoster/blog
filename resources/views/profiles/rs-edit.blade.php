@extends('layouts.app')
@section('content')
    <div class="container mt-5" style="max-width: 700px">
        @include('shared.alerts')
        <div class="mb-3">
            <h4 class="h3 text-info">Relationship Edit Page</h4>
        </div>
        <form action="{{ url("/users/profile/edit/".$user->id) }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="Relationship">Relationship</label>
                <select name="relationship_id" class="form-select">
                    @foreach ($relationship as $rs) 
                        @php
                            $selected = $rs->id == $user->relationship_id ? "selected" : "";
                        @endphp
                        <option value="{{ $rs->id }}" {{ $selected }}>
                            {{ $rs->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <a href="{{ url("/users/profile/$user->id") }}" class="btn btn-secondary ml-3">
                <i class="bi bi-arrow-left"></i> Back
            </a>
            <input type="submit" value="Update" class="btn btn-info text-white">
        </form>
    </div>
@endsection