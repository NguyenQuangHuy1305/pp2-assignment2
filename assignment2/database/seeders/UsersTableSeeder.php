<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Person A',
            'email' => 'A@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'moderator',
        ]);
        DB::table('users')->insert([
            'name' => 'Person B',
            'email' => 'B@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'member',
        ]);
        DB::table('users')->insert([
            'name' => 'Person C',
            'email' => 'C@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'member',
        ]);
        DB::table('users')->insert([
            'name' => 'Person D',
            'email' => 'D@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'member',
        ]);
        DB::table('users')->insert([
            'name' => 'Person E',
            'email' => 'E@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'member',
        ]);
        DB::table('users')->insert([
            'name' => 'Person F',
            'email' => 'F@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'member',
        ]);
        DB::table('users')->insert([
            'name' => 'Person G',
            'email' => 'G@gmail.com',
            'password' => bcrypt('123'),
            'role' => 'member',
        ]);


        DB::table('users')->insert([
            'name' => 'Moderator',
            'email' => 'Moderator@a.com',
            'password' => bcrypt('1234'),
            'role' => 'moderator',
        ]);
        DB::table('users')->insert([
            'name' => 'Chris',
            'email' => 'Chris@a.com',
            'password' => bcrypt('1234'),
            'role' => 'moderator',
        ]);
        DB::table('users')->insert([
            'name' => 'Member',
            'email' => 'Member@a.com',
            'password' => bcrypt('1234'),
            'role' => 'member',
        ]);
        DB::table('users')->insert([
            'name' => 'Cara',
            'email' => 'Cara@a.com',
            'password' => bcrypt('1234'),
            'role' => 'member',
        ]);
        DB::table('users')->insert([
            'name' => 'Bob',
            'email' => 'Bob@a.com',
            'password' => bcrypt('1234'),
            'role' => 'member',
        ]);
        DB::table('users')->insert([
            'name' => 'Fred',
            'email' => 'Fred@a.com',
            'password' => bcrypt('1234'),
            'role' => 'member',
        ]);
    }
}
