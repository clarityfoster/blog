
<form method="post">
    @csrf
    <div class="mb-3">
        <label for="title">Title</label>
        <input type="text" class="form-control" name="title">
    </div>
    <div class="mb-3">
        <label for="body">Body</label>
        <textarea type="text" class="form-control" name="body"></textarea>
    </div>
    <div class="mb-3">
        <label for="category">Category</label>
        <select name="category_id" class="form-select">
            @foreach ($category as $categories)
                <option value="{{ $categories['id'] }}">
                    {{ $categories['name'] }}
                </option>
            @endforeach
        </select>
    </div>
    <input type="submit" value="Add Article" class="btn btn-primary">
</form>