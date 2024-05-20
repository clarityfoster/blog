<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Follow;
use App\Models\User;

class FollowController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function follow($id) {
        $currentUserId = Auth::id();
        $profileUser = User::findOrFail($id);
        $follow = Follow::where('user_id', $profileUser->id)
                            ->where('current_user_id', $currentUserId)
                            ->first();
        if($follow) {
            return back()->with("already-followed", "Already followed this user!");
        }
        $follow = new Follow;
        $follow->user_id = $profileUser->id;
        $follow->current_user_id = $currentUserId;
        $follow->save();
        return back()->with('following', 'Successfully followed the user.');
    }
    public function unfollow($id) {
        $currentUserId = Auth::id();
        $profileUser = User::findOrFail($id);
        $follow = Follow::where('user_id', $profileUser->id)
                            ->where('current_user_id', $currentUserId)
                            ->first();
        if(!$follow) {
            return back();
        }
        $follow->delete();
        return back()->with('unfollow', 'Successfully unfollowed this user.');
    }
    public function followersList($id) {
        $users = User::findOrFail($id);
        return view("profiles.followers", [
            'user' => $users,
        ]);
    }
}
