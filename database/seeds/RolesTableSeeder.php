<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('roles')->insert([
            'name' => 'pro culturel',
            'slug' => 'procult',
            ]);

        DB::table('roles')->insert([
            'name' => 'pro de la grade',
            'slug' => 'progard',
            ]);

        DB::table('roles')->insert([
            'name' => 'organisateur',
            'slug' => 'orga',
            ]);
        
        DB::table('roles')->insert([
            'name' => 'admin',
            'slug' => 'admin',
            ]);
    }
}

//id implicite en 1 b2 3 parce que table id en incrément elle rmpli toute seule
