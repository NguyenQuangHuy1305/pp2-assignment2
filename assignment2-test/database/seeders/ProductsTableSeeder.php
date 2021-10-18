<?php

namespace Database\Seeders;

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
        DB::table('products')->insert([
            'name' => 'Car insurance',
            'price' => 600,
            'description' => 'description 1',
            'manufacturer_id' => 1,
            'product_url' => 'https://s5257464.elf.ict.griffith.edu.au/webAppDev/week9/assignment2/public/product/1',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('products')->insert([
            'name' => 'House insurance',
            'price' => 567,
            'description' => 'description 2',
            'manufacturer_id' => 2,
            'product_url' => 'https://s5257464.elf.ict.griffith.edu.au/webAppDev/week9/assignment2/public/product/2',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('products')->insert([
            'name' => 'Health insurance',
            'price' => 432,
            'description' => 'description 3',
            'manufacturer_id' => 1,
            'product_url' => 'https://s5257464.elf.ict.griffith.edu.au/webAppDev/week9/assignment2/public/product/3',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('products')->insert([
            'name' => 'Travel insurance',
            'price' => 100,
            'description' => 'description 4',
            'manufacturer_id' => 3,
            'product_url' => 'https://s5257464.elf.ict.griffith.edu.au/webAppDev/week9/assignment2/public/product/4',
            'updated_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
