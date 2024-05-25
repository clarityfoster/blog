<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Article; 
use App\Models\Category;
use App\Models\Privacy;
use App\Models\User;

class ArticleController extends Controller
{
    public function __construct() {
        $this->middleware('auth')->except(['index', 'detail']);
    }
    public function index() {
        $category = Category::all();
        $data = Article::latest()->paginate(5);
        return view('articles.index', [
            'articles' => $data,
            'categories' => $category,
        ]);
    }
    public function detail($id) {
        $data = Article::find($id);
        return view('articles.detail', [
            'article' => $data,
        ]);
    }
    public function delete($id) {
        $article = Article::find($id);
        if(Gate::allows('article-delete', $article )) {
            $article->delete();
            return redirect('/articles')->with('article-delete', 'Article deleted');
        } else {
            return back();
        }
    }
    public function add() {
        $categories = Category::all();
        $articles = Article::all();
        $privacies = Privacy::all();
        return view('articles.add', [
            'category' => $categories,
            'article' => $articles,
            'privacy' => $privacies
        ]);
    }
    public function create() {
        $validator = validator(request()->all(), [
            'title' => 'required',
            'body' => 'required',
            'category_id' => 'required',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator);
        }
        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->privacy_id = request()->privacy_id;
        $article->user_id = auth()->user()->id;
        $article->save();
        return redirect('/articles')->with('article-create', 'Article created');
    }
    public function edit($id) {
        $users = User::find($id);
        $articles = Article::find($id);
        $category = Category::all();
        $privacy = Privacy::all();
        if(Gate::allows('article-edit', $articles)) {
            return view('articles.edit', [
                'article' => $articles,
                'categories' => $category,
                'privacies' => $privacy,
                'user' => $users,
            ]);
        } else {
            return back();
        }
    }
    public function update($id) {
        $article = Article::find($id);

        if(
            $article->title == request()->title &&
            $article->body == request()->body &&
            $article->category_id == request()->category_id &&
            $article->privacy_id == request()->privacy_id 
        ) {
            return back()->with("no-update", "Nothing to update");
        }

        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->privacy_id = request()->privacy_id;
        $article->update();

        return redirect("/articles/detail/$id")->with('article-update', 'Article updated');
    }
    public function backBtnToIndex() {
        return view("articles.index");
    }
    public function backBtnToDetail() {
        return view("articles.detail");
    }
}
