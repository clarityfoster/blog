<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\User;
use App\Models\Relationship;
use App\Models\Follow;

class ProfileController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    public function profile($id) {
        $users = User::find($id);
        return view('profiles.profile', [
            'user' => $users,
        ]);
    }
    public function edit($id) {
        $currentUser = Auth::user();
        $profileUser = User::find($id);
        $relationships = Relationship::all();

        if(Gate::allows("edit-rs", $profileUser)) {
            return view('profiles.rs-edit', [
                "user" => $profileUser,
                "relationship" => $relationships,
            ]);
        } else {
            return back()->with('edit-rs', 'You are not allowed to edit this profile');
        }
    }
    public function update($id) {
        $user = User::find($id);

        if ($user->relationship_id == request()->relationship_id) {
            return back()->with("no-update", "Nothing to update");
        }
        $user->relationship_id = request()->relationship_id;
        $user->update();
        return redirect()->route('profile', ['id' => $user->id])->with('rs-status-fixed', 'Relationship status updated successfully');
    }
    public function editBio($id) {
        $currentUser = Auth::user();
        $profileUser = User::find($id);
        if(Gate::allows("edit-bio", $profileUser)) {
            return view('profiles.edit-bio', [
                'user' => $profileUser,
            ]);
        } else {
            return back()->with('edit-rs', "You are not allowed to edit this profile");
        }
    }
    public function updateBio(Request $request, $id) {
        $user = User::find($id);
        if ($user->bio == request()->bio) {
            return back()->with("no-update", "Nothing to update");
        }
        $user->bio = $request->bio;
        $user->save();
        return redirect()->route('profile', ['id' => $user->id])->with('bio-updated', 'Bio updated successfully');
    }
    public function showArticles($id) {
        $users = User::findOrFail($id);
        $articles = Article::find($id);
        return view('profiles.profile', [
            'user' => $users,
            'articles' => $articles
        ]);
    }
}
