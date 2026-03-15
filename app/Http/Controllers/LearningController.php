<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;


class LearningController extends Controller
{
    public function controlPanel(): View
    {
        return view('control-panel', [
            'products' => Product::all(),
            'articles' => Article::all(),
            'tags' => Tag::all(),
            'comments' => Comment::with('commentable')->get(),
            'taggables' => DB::table('taggables')->get(),
        ]);
    }

    public function storeProduct(Request $request): RedirectResponse
    {
        Product::create($request->validate([
            'title' => 'required'
        ]));

        return back();
    }

    public function storeArticle(Request $request)
    {
        Article::create($request->validate([
            'title' => 'required'
        ]));

        return back();
    }

    public function storeTag(Request $request)
    {
        Tag::create($request->validate([
            'name' => 'required'
        ]));

        return back();
    }

    public function storeComment(Request $request)
    {
        $data = $request->validate([
            'comment' => 'required',
            'type' => 'required',
            'model_id' => 'required'
        ]);

        if ($data['type'] === 'product') {
            Product::findOrFail($data['model_id'])
                ->comments()
                ->create(['comment' => $data['comment']]);
        }

        if ($data['type'] === 'article') {
            Article::findOrFail($data['model_id'])
                ->comments()
                ->create(['comment' => $data['comment']]);
        }

        return back();
    }

    public function attachTag(Request $request)
    {
        $data = $request->validate([
            'tag_id' => 'required',
            'type' => 'required',
            'model_id' => 'required'
        ]);

        if ($data['type'] === 'product') {
            Product::findOrFail($data['model_id'])
                ->tags()
                ->attach($data['tag_id']);
        }

        if ($data['type'] === 'article') {
            Article::findOrFail($data['model_id'])
                ->tags()
                ->attach($data['tag_id']);
        }

        return back();
    }

    public function detachTag(Request $request)
    {
        $data = $request->validate([
            'tag_id' => 'required',
            'type' => 'required',
            'model_id' => 'required'
        ]);

        if ($data['type'] === 'product') {
            Product::findOrFail($data['model_id'])
                ->tags()
                ->detach($data['tag_id']);
        }

        if ($data['type'] === 'article') {
            Article::findOrFail($data['model_id'])
                ->tags()
                ->detach($data['tag_id']);
        }

        return back();
    }

    public function deleteComment(Comment $comment)
    {
        $comment->delete();

        return back();
    }
}
