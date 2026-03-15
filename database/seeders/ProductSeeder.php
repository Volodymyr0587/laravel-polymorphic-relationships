<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create(['title' => 'Laptop']);
        Product::create(['title' => 'Smartphone']);
        Product::create(['title' => 'Keyboard']);
    }
}
