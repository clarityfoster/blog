<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Article;
use App\Models\Profile;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function delete($id) {
        $comment = Comment::find($id);
        if(Gate::allows("comment-delete", $comment)) {
            $comment->delete();
            return back()->with('cm-delete', "Comment deleted");
        } else {
            return back()->with();
        }
    }
    public function add() {
        $validator = validator(request()->all(), [
            'content' => 'required',
            'article_id' => 'required',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        $comment = new Comment;
        $comment->content = request()->content;
        $comment->article_id = request()->article_id;
        $comment->user_id = auth()->user()->id;
        $comment->save();
        return back()->with("cm-created", "Comment created");
    }
    public function view($id) {
        $articles = Article::find($id);
        $comment = Comment::find($id);
        return view("comments.view", [
            'comments' => $comment,
            'article' => $articles,
        ]);
    }
}
