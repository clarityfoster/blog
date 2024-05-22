<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;

class SearchController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function search(Request $request) {
        $query = $request->input("query");
        if($query) {
            $articles = Article::where('title', 'LIKE', "%{$query}%")
                                ->orWhere('body', 'LIKE', "%{$query}%")
                                ->get();
            $users = User::where('name', 'LIKE', "%{$query}%")->get();
        } else {
            return back();
        }
        return view('searchs.search-box', [
            'articles' => $articles,
            'query' => $query,
            'user' => $users
        ]);
    }
}
