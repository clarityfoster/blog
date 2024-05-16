<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Dislike;
use App\Models\Article;

class DislikeController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function dislike() {
        $userId = auth()->user()->id;
        $articleId = request()->article_id;
        $dislike = Dislike::where('article_id', $articleId)->where('user_id', $userId)->first();
        if($dislike) {
            return back();
        }
        $dislike = new Dislike;
        $dislike->user_id = $userId;
        $dislike->article_id = $articleId;
        $dislike->save();
        return back();
    }
    public function undislike($id) {
        $userId = auth()->user()->id;
        $dislike = Dislike::where('id', $id)->where('user_id', $userId)->first();
        if(!$dislike) {
           return back(); 
        }
        $dislike->delete();
        return back();
    }
    public function dislikeList($id) {
        $articles = Article::find($id);
        return view('reacts.dislike', [
            'article' => $articles,
        ]);
    }
}
