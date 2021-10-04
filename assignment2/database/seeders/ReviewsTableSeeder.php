<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'user_id' => 1,
            'user_name' => 'Person A',
            'product_id' => 1,
            'review_rating' => 5,
            'review_content' => "A's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('reviews')->insert([
            'user_id' => 2,
            'user_name' => 'Person B',
            'product_id' => 1,
            'review_rating' => 5,
            'review_content' => "B's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
            
        ]);
        DB::table('reviews')->insert([
            'user_id' => 3,
            'user_name' => 'Person C',
            'product_id' => 1,
            'review_rating' => 5,
            'review_content' => "C's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('reviews')->insert([
            'user_id' => 4,
            'user_name' => 'Person D',
            'product_id' => 1,
            'review_rating' => 5,
            'review_content' => "D's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('reviews')->insert([
            'user_id' => 5,
            'user_name' => 'Person E',
            'product_id' => 1,
            'review_rating' => 5,
            'review_content' => "E's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('reviews')->insert([
            'user_id' => 6,
            'user_name' => 'Person F',
            'product_id' => 1,
            'review_rating' => 5,
            'review_content' => "F's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('reviews')->insert([
            'user_id' => 7,
            'user_name' => 'Person G',
            'product_id' => 1,
            'review_rating' => 5,
            'review_content' => "G's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);


        DB::table('reviews')->insert([
            'user_id' => 2,
            'user_name' => 'Person B',
            'product_id' => 2,
            'review_rating' => 2,
            'review_content' => "B's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('reviews')->insert([
            'user_id' => 2,
            'user_name' => 'Person B',
            'product_id' => 4,
            'review_rating' => 4,
            'review_content' => "B's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('reviews')->insert([
            'user_id' => 3,
            'user_name' => 'Person C',
            'product_id' => 3,
            'review_rating' => 3,
            'review_content' => "C's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('reviews')->insert([
            'user_id' => 4,
            'user_name' => 'Person D',
            'product_id' => 4,
            'review_rating' => 2,
            'review_content' => "D's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('reviews')->insert([
            'user_id' => 5,
            'user_name' => 'Person E',
            'product_id' => 4,
            'review_rating' => 5,
            'review_content' => "E's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('reviews')->insert([
            'user_id' => 6,
            'user_name' => 'Person F',
            'product_id' => 2,
            'review_rating' => 3,
            'review_content' => "F's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
        DB::table('reviews')->insert([
            'user_id' => 7,
            'user_name' => 'Person G',
            'product_id' => 2,
            'review_rating' => 2,
            'review_content' => "G's review here",
            'like_count' => 0,
            'dislike_count' => 0,
            'created_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}