
<div class="mb-3">
    <h4 class="h3 text-info">Edit Page</h4>
</div>
<form method="post">
    @csrf
    <div class="mb-3">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title" value="{{ $article->title }}">
    </div>
    <div class="mb-3">
        <label for="body">Body</label>
        <textarea type="text" class="form-control" name="body">{{ $article->body }}</textarea>
    </div>
    <div class="mb-3">
        <label for="category">Category</label>
        <select name="category_id" class="form-select">
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
        <i class="bi bi-arrow-left"></i> Back
    </a>
    <input type="submit" value="Update Article" class="btn btn-info text-white">
</form>