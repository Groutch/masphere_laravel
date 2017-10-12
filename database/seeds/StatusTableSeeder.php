<?php

use Illuminate\Database\Seeder;

class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('status')->insert([
            //id => 1
            'procult' => null,
            'proguard' => 'Valider/Annuler',
            'other' => null,
            ]);

        DB::table('status')->insert([
            //id => 2
            'procult' => 'en attente de confirmation du pro',
            'proguard' => 'Valider/Annuler',
            'other' => null,
            ]);

        DB::table('status')->insert([
            //id => 3
            'procult' => 'Garde validée',
            'proguard' => 'Garde validée',
            'other' => 'Garde prise',
            ]);

        DB::table('status')->insert([
            //id => 4
            'procult' => 'Demande de garde rejetée',
            'proguard' => 'Demande de garde rejetée',
            'other' => null,
            ]);
    }
}
