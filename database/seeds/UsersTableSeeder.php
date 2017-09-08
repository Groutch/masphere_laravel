<?php

use Illuminate\Database\Seeder;

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
            'name' => 'procult',
            'email' => 'procult@gmail.com',
            'password' => bcrypt('azerty'),
            ]);
        DB::table('users')->insert([
            'name' => 'proguard',
            'email' => 'proguard@gmail.com',
            'password' => bcrypt('azerty'),
            ]);
        DB::table('users')->insert([
            'name' => 'organisateur',
            'email' => 'orga@gmail.com',
            'password' => bcrypt('azerty'),
            ]);
        DB::table('users')->insert([
            'name' => 'procult2',
            'email' => 'procult2@gmail.com',
            'password' => bcrypt('azerty'),
            ]);
        DB::table('users')->insert([
            'name' => 'proguard2',
            'email' => 'proguard2@gmail.com',
            'password' => bcrypt('azerty'),
            ]);
        DB::table('users')->insert([
            'name' => 'organisateur2',
            'email' => 'orga2@gmail.com',
            'password' => bcrypt('azerty'),
            ]);
    }
}
