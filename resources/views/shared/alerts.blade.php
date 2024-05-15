@if ($errors->any())
    <div class="alert alert-warning">
        <ol>
            @foreach ($errors->all() as $error)    
                <li>{{ $error }}</li>
            @endforeach
        </ol>
    </div>
@endif

@if(session('article-delete'))
    <div class="alert alert-danger">
        {{ session('article-delete') }}
    </div>
@endif

@if(session('article-create'))
    <div class="alert alert-success">
        {{ session('article-create') }}
    </div>
@endif

@if (session("unanthorized"))
    <div class="alert alert-warning">
        {{ session("unanthorized") }}
    </div>
@endif

@if (session('article-update')) 
    <div class="alert alert-info">
        {{ session('article-update') }}
    </div>
@endif

@if (session('cm-created')) 
    <div class="alert alert-success">
        {{ session('cm-created') }}
    </div>
@endif

@if (session('cm-delete')) 
    <div class="alert alert-danger">
        {{ session('cm-delete') }}
    </div>
@endif

@if (session('no-update'))
    <div class="alert alert-warning">
        {{ session('no-update') }}
    </div>
@endif
