<?php

use Illuminate\Database\Seeder;

class EventUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('event_user')->insert([
            'user_id' => 3,
            'event_id' => 1
            ]);
    	DB::table('event_user')->insert([
            'user_id' => 6,
            'event_id' => 2
            ]);
        DB::table('event_user')->insert([
    		'user_id' => 3,
    		'event_id' => 3
    		]);
    }
}
