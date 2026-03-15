<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class PolymorphicController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::with('comments')->get();
        $articles = Article::with('comments')->get();
        $comments = Comment::with('commentable')->get();

        return view('polymorphic-example', compact('products', 'articles', 'comments'));
    }
}
