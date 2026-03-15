<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::first();

        $product->comments()->createMany([
            ['comment' => 'Great product'],
            ['comment' => 'Worth the price'],
        ]);

        $article = Article::first();

        $article->comments()->createMany([
            ['comment' => 'Very helpful article'],
            ['comment' => 'Nice explanation'],
        ]);
    }
}
