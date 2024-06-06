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

@if(session('bio-updated'))
    <div class="alert alert-success">
        {{ session('bio-updated') }}
    </div>
@endif

@if (session("rs-status-fixed"))
    <div class="alert alert-success">
        {{ session("rs-status-fixed") }}
    </div>
@endif
@if (session("edit-rs"))
    <div class="alert alert-warning">
        {{ session("edit-rs") }}
    </div>
@endif
@if (session("following"))
    <div class="alert alert-success">
        {{ session("following") }}
    </div>
@endif
@if (session("already-followed"))
    <div class="alert alert-warning">
        {{ session("already-followed") }}
    </div>
@endif
@if (session("error"))
    <div class="alert alert-warning">
        {{ session("error") }}
    </div>
@endif
@if (session("unfollow"))
    <div class="alert alert-danger">
        {{ session("unfollow") }}
    </div>
@endif
@if (session("profile-img-updated"))
    <div class="alert alert-success">
        {{ session("profile-img-updated") }}
    </div>
@endif
@if (session("cover-img-updated"))
    <div class="alert alert-info">
        {{ session("cover-img-updated") }}
    </div>
@endif
