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
        $article = Article::findOrFail($id);
        $users = User::find($id);
        return view('profiles.profile', [
            'user' => $users,
            'article' => $article
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
    public function indicators($id) {
        $currentUser = Auth::user();
        $profileUser = User::find($id);
        if(Gate::allows('upload-img', $profileUser)) {
            return view('profiles.indicate', [
                'user' => $profileUser,
            ]);
        } else {
            return back()->with('unanthorized', 'Unanthorized!');
        }
    }
    public function uploadProfile($id) {
        $currentUser = Auth::user();
        $profileUser = User::find($id);
        if(Gate::allows('upload-img', $profileUser)) {
            return view('profiles.profile-img', [
                'user' => $profileUser,
            ]);
        } else {
            return back()->with('unanthorized', 'Unanthorized!');
        }
    }
    public function createProfileImg(Request $request, $id) { 
        $validator = validator($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'profile_caption' => 'required|max:255',
        ]);
        
        $profileUser = User::findOrFail($id);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
    
        if (request()->hasFile('image')) {
            $imgPath = request()->file('image')->store('profile-img', 'public');
            $profileUser->image = $imgPath;
        }
    
        $profileUser->profile_caption = $request->profile_caption;
        $profileUser->save();
    
        return redirect()->route('profile', [
            'id' => $profileUser->id,
            'user' => $profileUser,
        ])->with('profile-img-updated', 'Profile photo uploaded successfully');
    }
    public function uploadCover($id) {
        $currentUser = Auth::user();
        $profileUser = User::find($id);
        if(Gate::allows('upload-img', $profileUser)) {
            return view('profiles.cover-img', [
                'user' => $profileUser,
            ]);
        } else {
            return back()->with('unanthorized', 'Unanthorized!');
        }
    }
    public function createCoverImg(Request $request, $id) { 
        $validator = validator($request->all(), [
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif',
            'cover_caption' => 'required|max:255',
        ]);
        $profileUser = User::findOrFail($id);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        if (request()->hasFile('cover_image')) {
            $coverImgPath = request()->file('cover_image')->store('cover-img', 'public');
            $profileUser->cover_image = $coverImgPath;
        }
        $profileUser->cover_caption = $request->cover_caption;
        $profileUser->save();
        return redirect()->route('profile', [
            'id' => $profileUser->id,
            'user' => $profileUser,
        ])->with('cover-img-updated', 'Cover photo uploaded successfully');
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
        $validator = validator(request()->all(), [
            'bio' => "required|max:110",
        ]);
        if(($validator)->fails()) {
            return back()->withErrors($validator);
        }
        $user = User::find($id);
        if ($user->bio == request()->bio) {
            return back()->with("no-update", "Nothing to update");
        }
        $user->bio = $request->bio;
        $user->save();
        return redirect()->route('profile', ['id' => $user->id])->with('bio-updated', 'Bio updated successfully');
    }
    public function usersList() {
        $users = User::all();
        return view("shared.users-list", [
            "user" => $users
        ]);
    }
    public function profilePhoto($id) {
        $article = Article::find($id);
        $user = User::find($id);
        return view('profiles.profile-photo', [
            'article' => $article,
            'user' => $user,
        ]);
    }
    public function coverPhoto($id) {
        $article = Article::find($id);
        $user = User::find($id);
        return view('profiles.cover-photo', [
            'article' => $article,
            'user' => $user,
        ]);
    }
    public function showArticles($id) {
        $profileUser = User::find($id);
        $currentUser = Auth::user();
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
        return view('profiles.profile', [
            'user' => $profileUser,
            'article' => $data,
        ]);
    }
}