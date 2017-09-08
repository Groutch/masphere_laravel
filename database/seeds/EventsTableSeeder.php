<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('events')->insert([
            'nom' => 'Debout Les Morts',
            'debut' => time()+(24*60*60),
            'fin' => time()+(2*25*60*60),
            'list_groups' => '["Blackest Night, tome 1","Blackest Night, tome 2","Blackest Night, tome 3","Blackest Night, tome 4","Blackest Night, tome 5"]',
            'billetterie' => 'https://www.senscritique.com/bd/Debout_les_morts_Blackest_Night_tome_1/456017',
            'textbox' => 'Suite à son suicide, le super-criminel, Black Hand devient l’agent d’une mystérieuse entité, et ressuscite à ses côtés des super-héros décédés. Le Corps des Green Lantern et la Ligue de Justice pourront-ils repousser cette invasion de zombies surpuissants ?',
            ]);

        DB::table('events')->insert([
            'nom' => 'Totipotent',
            'debut' => time()+(2*24*60*60),
            'fin' => time()+(4*25*60*60),
            'list_groups' => '["multipotent","omnipotent","pluripotent","unipotent"]',
            'billetterie' => 'https://www.senscritique.com/bd/Debout_les_morts_Blackest_Night_tome_1/456017',
            'textbox' => 'Qualifie les cellules qui, par mitose, peuvent produire tous les types de cellules d\'un corps, et qui ont ainsi le potentiel de former un animal entier ou une plante entière.',
            ]);
    }
}

//id implicite en 1 b2 3 parce que table id en incrément elle rmpli toute seule
