<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Models\React;

class ReactController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }
    public function like(Request $request) {
        $userId = auth()->user()->id;
        $articleId = request()->article_id;
        $like = React::where('article_id', $articleId)->where('user_id', $userId)->first();
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
        if (!$like) {
            return back();
        }
        $like->delete();
        return back();
    }
}
