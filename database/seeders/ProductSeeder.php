<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('products')->insert([
            ['name' => 'Item 1', 'price' => 9.99, 'amount_available' => 10],
            ['name' => 'Item 2', 'price' => 19.99, 'amount_available' => 15],
            ['name' => 'Item 3', 'price' => 29.99, 'amount_available' => 25],
            ['name' => 'Item 4', 'price' => 14.99, 'amount_available' => 15],
            ['name' => 'Item 5', 'price' => 24.99, 'amount_available' => 25],
            ['name' => 'Item 6', 'price' => 29.99, 'amount_available' => 15],
            ['name' => 'Item 7', 'price' => 23.99, 'amount_available' => 25],
        ]);
    }
}
