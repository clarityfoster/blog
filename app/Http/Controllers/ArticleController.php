<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; 

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
}
