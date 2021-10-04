<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class FollowsTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('follows')->insert([
            'follower_user_id' => 1,
            'followed_user_id' => 2,
            'followed_user_name' => 'Person B',
        ]);
        DB::table('follows')->insert([
            'follower_user_id' => 1,
            'followed_user_id' => 4,
            'followed_user_name' => 'Person D',
        ]);
        DB::table('follows')->insert([
            'follower_user_id' => 1,
            'followed_user_id' => 6,
            'followed_user_name' => 'Person F',
        ]);


        DB::table('follows')->insert([
            'follower_user_id' => 2,
            'followed_user_id' => 1,
            'followed_user_name' => 'Person A',
        ]);
        DB::table('follows')->insert([
            'follower_user_id' => 2,
            'followed_user_id' => 3,
            'followed_user_name' => 'Person C',
        ]);
        DB::table('follows')->insert([
            'follower_user_id' => 2,
            'followed_user_id' => 5,
            'followed_user_name' => 'Person E',
        ]);
        DB::table('follows')->insert([
            'follower_user_id' => 2,
            'followed_user_id' => 7,
            'followed_user_name' => 'Person G',
        ]);


        DB::table('follows')->insert([
            'follower_user_id' => 3,
            'followed_user_id' => 1,
            'followed_user_name' => 'Person A',
        ]);
        DB::table('follows')->insert([
            'follower_user_id' => 3,
            'followed_user_id' => 5,
            'followed_user_name' => 'Person E',
        ]);


        DB::table('follows')->insert([
            'follower_user_id' => 4,
            'followed_user_id' => 7,
            'followed_user_name' => 'Person G',
        ]);
        DB::table('follows')->insert([
            'follower_user_id' => 4,
            'followed_user_id' => 1,
            'followed_user_name' => 'Person A',
        ]);

        DB::table('follows')->insert([
            'follower_user_id' => 5,
            'followed_user_id' => 2,
            'followed_user_name' => 'Person B',
        ]);
        DB::table('follows')->insert([
            'follower_user_id' => 6,
            'followed_user_id' => 4,
            'followed_user_name' => 'Person D',
        ]);
    }
}
