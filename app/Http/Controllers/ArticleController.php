<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
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

        return view('articles.index', [
            'articles' => $data,
            'categories' => $category,
        ]);
    }
    public function detail($id) {
        $currentUser = auth()->user();
        $data = Article::where('id', $id)
            ->where(function ($query) use ($currentUser) {
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
            })->first();
    
        if (!$data) {
            return redirect()->route('articles.index')->with('error', 'Article not found or you do not have permission to view it.');
        }
    
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
            'article_image.*' => 'nullable|image|mimes:jpeg,jpg,png,gif',
        ]);
        if($validator->fails()) {
            return back()->withErrors($validator);
        }

        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        if(request()->hasFile('article_image')) {
            $articleImgPath = [];
            foreach(request()->file('article_image') as $image) {
                $imagePath = $image->store('article-img', 'public');
                $articleImgPath[] = $imagePath; 
            }
            $article->article_image = json_encode($articleImgPath);
        } else {
            $article->article_image = json_encode([]);
        }
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
    public function articlePhoto($id, $imageIndex) {
        $article = Article::findOrFail($id);
        $images = json_decode($article->article_image, true);
        if(is_array($images) && isset($images[$imageIndex])) {
            $image = $images[$imageIndex];
        } else {
            abort(404, "Image not found");
        }
        return view('articles.article-photo', [
            'article' => $article,
            'image' => $image,
            'imageIndex' => $imageIndex
        ]);
    }
}
