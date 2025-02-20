<?php

use App\Models\Article;
use App\Models\ArticleComment;
use App\Models\Product;
use App\Models\ProductComment;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    // for ($i=1; $i <= 10; $i++) {
    //     Article::create([
    //         'title' => "Article $i"
    //     ]);
    // }

    // for ($i=1; $i <= 10; $i++) {
    //     Product::create([
    //         'title' => "Product $i"
    //     ]);
    // }

    // for ($i=0; $i < 100; $i++) {
    //     ArticleComment::create([
    //         'article_id' => rand(1, 10), // Article::all()->random()->id,
    //         'comment' => "Comment $i",
    //     ]);
    // }

    // for ($i=0; $i < 100; $i++) {
    //     ProductComment::create([
    //         'product_id' => rand(1, 10), // Article::all()->random()->id,
    //         'comment' => "Comment $i",
    //     ]);
    // }

    // $article = Article::with('comments')->find(1);
    // dd($article);

    // $article = Article::find(3);
    // dump($article->comments);

    // $product = Product::find(3);
    // dump($product->comments);

   /*  $models = [
        1 => ['name' => 'Article', 'model' => 'App\Models\Article'],
        2 => ['name' => 'Product', 'model' => 'App\Models\Product'],
    ];
    for ($i=0; $i < 100 ; $i++) {
        $model = rand(1, 2);
        \App\Models\Comment::create([
            'comment' => "{$models[$model]['name']} Comment $i",
            'commentable_id' => rand(1, 10),
            'commentable_type' => $models[$model]['model'],
        ]);
    } */

    //% Polymorphic

    // $firstArticle = Article::find(5);
    // $firstArticle->polyComments()->create([
    //     'comment' => 'Comment for first Article',
    // ]);

    $article = Article::with('polyComments')->find(5);
    // dump($article->polyComments);
    // dump($article);
    echo "<h1>{$article->title}</h1>";
    foreach ($article->polyComments as $comment) {
        echo "<p>{$comment->comment}</p>";
    }

    $product = Product::with('polyComments')->find(5);
    // dump($product->polyComments);
    // dump($product);
    echo "<h1>{$product->title}</h1>";
    foreach ($product->polyComments as $comment) {
        echo "<p>{$comment->comment}</p>";
    }


    return '';
});
