<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function profile($id) {
        $users = User::find($id);
        return view('articles.profile', [
            'user' => $users,
        ]);
    }
}
