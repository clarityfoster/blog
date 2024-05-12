<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; 
use App\Models\Category; 

class ArticleController extends Controller
{
    public function index() {
        $data = Article::latest()->paginate(10);
        return view('articles.index', [
            'articles' => $data,
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
        $article->delete();
        return redirect('/articles')->with('danger', 'Article deleted');
    }
    public function add() {
        $categories = Category::all();
        $articles = Article::all();
        return view('articles.add', [
            'category' => $categories,
            'article' => $articles,
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
        $article->save();
        return redirect('/articles')->with('success', 'Article created');
    }
    public function edit($id) {
        $articles = Article::find($id);
        $category = Category::all();
        return view('articles.edit', [
            'article' => $articles,
            'categories' => $category,
        ]);
    }
    public function update($id) {
        $article = Article::find($id);

        if(
            $article->title == request()->title ||
            $article->body == request()->body ||
            $article->category_id == request()->title 
        ) {
            return back()->with('warning', "Nothing to update");
        }

        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->update();

        return redirect("/articles/detail/$id")->with('info', 'Article updated');
    }
    public function backBtnToIndex() {
        return view("articles.index");
    }
    public function backBtnToDetail() {
        return view("articles.detail");
    }
}
