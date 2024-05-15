<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReactController extends Controller
{
    public function __construct() {
        return $this->middleware('auth');
    }
    public function like($id) {

    }
    public function unlike($id) {
        
    }
}
