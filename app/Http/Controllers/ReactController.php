<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Models\React;
use App\Models\Dislike;
use App\Models\Profile;

class ReactController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }
    public function like(Request $request) {
        $userId = auth()->user()->id;
        $articleId = request()->article_id;
        $like = React::where('article_id', $articleId)->where('user_id', $userId)->first();

        if(auth()->user()->ban) {
            return back()->with("suspended", "Your account has been suspended");
        }
        if ($like) {
            return back();
        }
        $like = new React;
        $like->user_id = auth()->user()->id;
        $like->article_id = request()->article_id;
        $like->save();
        return back();
    }
    public function unlike($id) {
        $userId = auth()->user()->id;
        $like = React::where('id', $id)->where('user_id', $userId)->first();
        if(auth()->user()->ban) {
            return back()->with("suspended", "Your account has been suspended");
        }
        if (!$like) {
            return back();
        }
        $like->delete();
        return back();
    }
    public function likeList($id) {
        $articles = Article::find($id);
        return view("reacts.like", [
            'article' => $articles
        ]);
    }
}
