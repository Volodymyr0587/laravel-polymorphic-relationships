<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Article;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            ProductSeeder::class,
            ArticleSeeder::class,
            CommentSeeder::class,
            TagSeeder::class,
        ]);

        $product = Product::first();
        $article = Article::first();

        $tag1 = Tag::find(1);
        $tag2 = Tag::find(2);

        $product->tags()->attach([$tag1->id, $tag2->id]);
        $article->tags()->attach([$tag2->id]);
    }
}
