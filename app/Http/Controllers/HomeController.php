<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; 
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $currentUser = auth()->user();
        $category = Category::all();
    
        $data = Article::where(function ($query) use ($currentUser) {
            $query->where('privacy_id', 1)
                ->orWhere(function ($query) use ($currentUser) {
                    if ($currentUser) {
                        $query->where('privacy_id', 2)
                                ->whereHas('user.followers', function ($query) use ($currentUser) {
                                    $query->where('current_user_id', $currentUser->id);
                                })->orWhere('user_id', $currentUser->id);
                    }
                })
                ->orWhere(function ($query) use ($currentUser) {
                    if ($currentUser) {
                        $query->where('privacy_id', 3)
                                ->where('user_id', $currentUser->id);
                    }
                });
        })->latest()->paginate(4);

        return view('home', [
            'articles' => $data,
            'categories' => $category,
        ]);
    }
}
