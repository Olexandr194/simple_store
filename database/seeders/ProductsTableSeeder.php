<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i <10; $i++)
        DB::table('products')->insert([
            'title' => 'Product ' . $i,
            'price' => rand(100, 2000),
            'description' => 'Some seeding operations may cause you to alter or lose data. In order to protect you from running seeding commands against your production database, you will be prompted for confirmation before the seeders are executed in the production environment. To force the seeders to run without a prompt, use the --force flag',
            'image' => 'product_' . rand(1, 12) . '.jpg',
            'quantity' => rand(10, 20),
            'is_available' => 1,
            'is_published' => 1,
            'category_id' => rand(1, 3),
        ]);
    }
}
