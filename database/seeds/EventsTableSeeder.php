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
            'lat' => 43.594083,
            'long' => 1.449471,
            'place' => 'Muséum de Toulouse, Allée Jules Guesde, Toulouse, France',
            'debut' => time()+(24*60*60),
            'fin' => time()+(2*25*60*60),
            'list_performs' => '["Blackest Night, tome 1","Blackest Night, tome 2","Blackest Night, tome 3","Blackest Night, tome 4","Blackest Night, tome 5"]',
            'billetterie' => 'https://www.senscritique.com/bd/Debout_les_morts_Blackest_Night_tome_1/456017',
            'textbox' => 'Suite à son suicide, le super-criminel, Black Hand devient l’agent d’une mystérieuse entité, et ressuscite à ses côtés des super-héros décédés. Le Corps des Green Lantern et la Ligue de Justice pourront-ils repousser cette invasion de zombies surpuissants ?',
            ]);

        DB::table('events')->insert([
            'nom' => 'Totipotent',
            'lat' => 43.608292,
            'long' => 1.441766,
            'place' => 'Basilique Saint-Sernin de Toulouse, Place Saint-Sernin, Toulouse, France',
            'debut' => time()+(2*24*60*60),
            'fin' => time()+(4*25*60*60),
            'list_performs' => '["multipotent","omnipotent","pluripotent","unipotent"]',
            'billetterie' => 'https://fr.wikipedia.org/wiki/Totipotence',
            'textbox' => 'Qualifie les cellules qui, par mitose, peuvent produire tous les types de cellules d\'un corps, et qui ont ainsi le potentiel de former un animal entier ou une plante entière.',
            ]);

        DB::table('events')->insert([
            'nom' => 'Albert Einstein',
            'lat' => 43.641478,
            'long' => 1.450577,
            'place' => 'Metronum, Toulouse, France',
            'debut' => time()+(4*24*60*60),
            'fin' => time()+(5*12*30*60),
            'list_performs' => '["Prix Nobel de physique","Loi de Nernst-Einstein","Statistique de Bose-Einstein","Mileva Einstein"]',
            'billetterie' => 'https://fr.wikipedia.org/wiki/Albert_Einstein',
            'textbox' => 'Albert Einstein, né le 14 mars 1879 à Ulm, dans le Wurtemberg, et mort le 18 avril 1955 à Princeton, dans le New Jersey, est un physicien théoricien qui fut successivement allemand, apatride (1896), suisse (1901) et de double nationalité helvético-américaine (1940).
            Il est aujourd\'hui considéré comme l\'un des plus grands scientifiques de l\'histoire, et sa renommée dépasse largement le milieu scientifique. Il est la personnalité du xxe siècle selon l\'hebdomadaire Time..',
            ]);
    }
}

//id implicite en 1 b2 3 parce que table id en incrément elle rmpli toute seule
