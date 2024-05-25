
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
    <div class="mb-3">
        <label for="privacy">Privacy</label>
        <select name="privacy_id" class="form-select">
            @foreach ($privacy as $privacies)
                <option value="{{ $privacies->id }}">
                    <i class="{{ $privacies->icons }}"></i> {{ $privacies->name }}
                </option>
            @endforeach
        </select>
    </div>
    <input type="submit" value="Add Article" class="btn btn-primary">
</form>
