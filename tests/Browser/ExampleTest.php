<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;
use App\Event;

class ExampleTest extends DuskTestCase
{
	/**
	* A basic browser test example.
	*
	* @return void
	*/
	// public function testLoginSee()
	// {
	// 	$this->browse(function (Browser $browser) {
	// 		$browser
	// 		->visit('/login')
	// 		->assertSee('Password');
	// 	});
	// }

	// public function testConnection() {
	// 	$user = User::find(1);
	// 	$this->browse(function ($browser) use ($user) {
	// 		$browser
	// 		->visit('/login')
	// 		->type('email', $user->email)
	// 		->type('password', 'azerty')
	// 		->press('Login')
	// 		->assertPathIs('/procult');
	// 	});
	// }

	// public function testSenarii(){

	// 	$event_bot_name = 'eventbot/'.substr(md5(mt_rand()), 0, 7);
	// 	$event_bot_name2 = 'eventbot2/'.substr(md5(mt_rand()), 0, 7);

	// 	$this->browse(function($orga, $orga2, $proguard) use ($event_bot_name, $event_bot_name2) {

	// 		$orga
	// 		->visit('/login')
	// 		->type('email', 'orga@gmail.com')
	// 		->type('password', 'azerty')
	// 		->press('Login')
	// 		->visit('/event_creation')
	// 		->type('nom', $event_bot_name)
	// 		->type('place', substr(md5(mt_rand()), 0, 7))
	// 		->type('list_performs[0]', substr(md5(mt_rand()), 0, 7))
	// 		->press('ajouter un spectacle de plus')
	// 		->type('list_performs[1]', substr(md5(mt_rand()), 0, 7))
	// 		->press('ajouter un spectacle de plus')
	// 		->type('list_performs[2]', substr(md5(mt_rand()), 0, 7))
	// 		->press('ajouter un spectacle de plus')
	// 		->type('list_performs[3]', substr(md5(mt_rand()), 0, 7))
	// 		->press('Créer l\'événement')
	// 		->waitForText($event_bot_name)
	// 		->assertSee($event_bot_name)
	// 		->assertDontSee('Whoops')
	// 		;

	// 		$orga2
	// 		->visit('/login')
	// 		->type('email', 'orga2@gmail.com')
	// 		->type('password', 'azerty')
	// 		->press('Login')
	// 		->visit('/event_list_orga')
	// 		->assertDontSee($event_bot_name2)
	// 		->visit('/event_creation')
	// 		->type('nom', $event_bot_name2)
	// 		->type('place', substr(md5(mt_rand()), 0, 7))
	// 		->type('list_performs[0]', substr(md5(mt_rand()), 0, 7))
	// 		->press('ajouter un spectacle de plus')
	// 		->type('list_performs[1]', substr(md5(mt_rand()), 0, 7))
	// 		->press('ajouter un spectacle de plus')
	// 		->type('list_performs[2]', substr(md5(mt_rand()), 0, 7))
	// 		->press('ajouter un spectacle de plus')
	// 		->type('list_performs[3]', substr(md5(mt_rand()), 0, 7))
	// 		->press('Créer l\'événement')
	// 		->waitForText($event_bot_name2)
	// 		->assertSee($event_bot_name2)
	// 		->assertDontSee('Whoops')
	// 		;

	// 		$orga
	// 		->visit('event_list_orga')
	// 		->assertDontSee($event_bot_name2)
	// 		->assertDontSee('Whoops')
	// 		;


	// 	});
	// 	$this->assertDatabaseHas('events', [
	// 		'nom' => $event_bot_name
	// 		]);
	// 	$this->assertDatabaseHas('events', [
	// 		'nom' => $event_bot_name2
	// 		]);
	// }
	
	// public function test2ndSenarii(){
	// 	// 
	// 	$randEvent = Event::find(mt_rand(1, count(Event::all())));
	// 	$event_bot_name3 = 'eventbot3/'.substr(md5(mt_rand()), 0, 7);

	// 	$this->browse(function($orga3, $proguard) use ($randEvent, $event_bot_name3) {

	// 		$orga3
	// 		->visit('/login')
	// 		->type('email', 'orga2@gmail.com')
	// 		->type('password', 'azerty')
	// 		->press('Login')
	// 		->visit('/event_creation')
	// 		->type('nom', $event_bot_name3)
	// 		->type('place', substr(md5(mt_rand()), 0, 7))
	// 		->type('list_performs[0]', substr(md5(mt_rand()), 0, 7))
	// 		->press('ajouter un spectacle de plus')
	// 		->type('list_performs[1]', substr(md5(mt_rand()), 0, 7))
	// 		->press('ajouter un spectacle de plus')
	// 		->type('list_performs[2]', substr(md5(mt_rand()), 0, 7))
	// 		->press('ajouter un spectacle de plus')
	// 		->type('list_performs[3]', substr(md5(mt_rand()), 0, 7))
	// 		->press('Créer l\'événement')
	// 		->waitForText($event_bot_name3)
	// 		->assertDontSee('Whoops')
	// 		;

	// 		$proguard
	// 		->visit('/login')
	// 		->type('email', 'proguard@gmail.com')
	// 		->type('password', 'azerty')
	// 		->press('Login')
	// 		->visit('/event_search')
	// 		->assertSee($event_bot_name3)
	// 		->visit('/event_details_proguard/'.$randEvent->id)
	// 		->assertSee('S\'inscrire')
	// 		->assertSee($randEvent->nom)
	// 		->assertDontSee('Whoops')
	// 		;
	// 	});
	// }

	// public function testRoutes(){
	// 	$this->browse(function($orga4, $proguard2, $procult2) {
	// 		$orga4
	// 		->visit('login')
	// 		->type('email', 'proguard@gmail.com')
	// 		->type('password', 'azerty')
	// 		->visit('/event_search')
	// 		->assertSee('')
	// 		;
	// 	});

	// public function testProgardEvent(){
	// 	$event = Event::find(2);
	// 	$text = '';
	// 	for($i=0; $i<10; $i++){
	// 		$text .= substr(md5(mt_rand()), 0, mt_rand(2, 4)).' '.substr(md5(mt_rand()), 0, mt_rand(2, 6));
	// 	}
	// 	$this->browse(function($browser) use ($event, $text){
	// 		$browser
	// 		->visit('login')
	// 		->type('email', 'proguard@gmail.com')
	// 		->type('password', 'azerty')
	// 		->press('Login')
	// 		->visit('event_search')
	// 		->waitForText('Détails')
	// 		->click('#'.$event->id)
	// 		->waitForText('S\'inscrire')
	// 		->click('#event_sub_proguard')
	// 		->type('list_places[0]', 'Au pays des ' . substr(md5(mt_rand()), 0, mt_rand(5, 8)))
	// 		->type('list_child_nbs[0]', mt_rand(1, 4))
	// 		->type('list_range[0]', mt_rand(0, 15))
	// 		->press('ajouter un lieu de plus')
	// 		->type('list_places[1]', 'plus loin vers' . substr(md5(mt_rand()), 0, mt_rand(4, 7)))
	// 		->type('list_child_nbs[1]', mt_rand(1, 4))
	// 		->type('list_range[1]', mt_rand(0, 15))
	// 		// ->type('debutDate', date("Y-m-d", $event->debut))
	// 		// ->type('debutHeure', date('H:i', $event->debut))
	// 		// ->type('finDate', date("Y-m-d", $event->fin))
	// 		// ->type('finHeure', date('H:i', $event->fin))
	// 		->type('textbox', $text)
	// 		->press('Créer l\'annonce')
	// 		->visit('event_list_proguard')
	// 		->assertSee('Vos gardes')
	// 		->assertSee($event->nom)
	// 		;
	// 	});
	// 	// $this->assertDatabaseHas('guards', [
	// 	// 	'nom' => $event_bot_name
	// 	// 	]);
	// }

	public function testInscriptionProcultsSurProguards(){
		$event = Event::find(2);
		$text = '';
		for($i=0; $i<10; $i++){
			$text .= substr(md5(microtime()),rand(0,26),5).' '.substr(md5(microtime()),rand(0,26),5);
		};
		$place1 = substr(md5(mt_rand()), 0, mt_rand(5, 8));
		$place2 = substr(md5(mt_rand()), 0, mt_rand(4, 7));


		$this->browse(function($procult, $proguard) use ($event, $text, $place1, $place2){

			$proguard
			->visit('login')
			->type('email', 'proguard@gmail.com')
			->type('password', 'azerty')
			->press('Login')
			->visit('event_search')
			->click('#'.$event->id)
			->waitForText('S\'inscrire')
			->assertSee($event->nom)
			->click('#event_sub_proguard')
			->waitForText('Mettre une annonce sur l\'événement')
			->type('list_places[0]', 'Au pays des ' . $place1)
			->type('list_child_nbs[0]', mt_rand(1, 4))
			->type('list_range[0]', mt_rand(0, 15))
			->press('ajouter un lieu de plus')
			->type('list_places[1]', 'plus loin vers ' . $place2)
			->type('list_child_nbs[1]', mt_rand(1, 4))
			->type('list_range[1]', mt_rand(0, 15))
			// ->type('debutDate', date("Y-m-d", $event->debut))
			// ->type('debutHeure', date('H:i', $event->debut))
			// ->type('finDate', date("Y-m-d", $event->fin))
			// ->type('finHeure', date('H:i', $event->fin))
			->type('textbox', $text)
			->press('Créer l\'annonce')
			;

			$procult
			->visit('login')
			->type('email', 'procult@gmail.com')
			->type('password', 'azerty')
			->press('Login')
			->visit('event_search')
			->waitForText('Détails')
			->click('#'.$event->id)
			->waitForText('S\'inscrire')
			->click('#event_sub_procult')
			->assertSee('Au pays des ' . $place1)
			->assertSee('plus loin vers ' . $place2)
			// ->type('debutDate', date("Y-m-d", $event->debut))
			// ->type('debutHeure', date('H:i', $event->debut))
			// ->type('finDate', date("Y-m-d", $event->fin))
			// ->type('finHeure', date('H:i', $event->fin))
			->type('textbox', $text)
			->press('Envoyer la demande')
			->visit('event_list_procult')
			->assertSee('Vos gardes')
			->assertSee($event->nom)
			;
		});
		// $this->assertDatabaseHas('guards', [
		// 	'nom' => $event_bot_name
		// 	]);
	}


	// public function testConnectionOrga() {
	// 	$user = User::find(1);
	// 	$this->browse(function ($browser) use ($user) {
	// 		$browser
	// 		->visit('/login')
	// 		->type('email', $user->email)
	// 		->type('password', 'azerty')
	// 		->press('Login')
	// 		->assertPathIs('/orga');
	// 	});
	// }

}
