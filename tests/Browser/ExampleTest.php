<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\Model\User;
use App\Model\Event;

class ExampleTest extends DuskTestCase
{
	/**
	* A basic browser test example.
	*
	* @return void
	*/
	public function testLoginSee()
	{
		$this->browse(function (Browser $browser) {
			$browser
			->visit('/login')
			->assertSee('Password')
			;
		});
	}

	public function testConnection() {
		$user = User::find(1);
		$this->browse(function ($browser) use ($user) {
			$browser
			->visit('/')
			->type('email', $user->email)
			->type('password', 'azerty')
			->press('Login')
			->assertPathIs('/event_list_procult')
			->click('#logoutlink')
			;
		});
	}

	public function testSenarii(){

		$event_bot_name = 'eventbot/'.substr(md5(mt_rand()), 0, 7);
		$event_bot_name2 = 'eventbot2/'.substr(md5(mt_rand()), 0, 7);

		$this->browse(function($orga, $orga2, $proguard) use ($event_bot_name, $event_bot_name2) {

			$orga
			->visit('/login')
			->type('email', 'orga@gmail.com')
			->type('password', 'azerty')
			->press('Login')
			->click('#create')
			->type('nom', $event_bot_name)
			->type('billetterie', 'https://fr.wikipedia.org/wiki/Wikip%C3%A9dia:Accueil_principal')
			->type('place', '16 Rue de l\'Industrie, Toulouse, France')
			// ->type('finHeure', '23:30')
			->type('list_performs[0]', substr(md5(mt_rand()), 0, 7))
			->press('ajouter un spectacle de plus')
			->type('list_performs[1]', substr(md5(mt_rand()), 0, 7))
			->press('ajouter un spectacle de plus')
			->type('list_performs[2]', substr(md5(mt_rand()), 0, 7))
			->press('ajouter un spectacle de plus')
			->type('list_performs[3]', substr(md5(mt_rand()), 0, 7))
			->type('textbox', substr(md5(mt_rand()), 0, 7))
			->press('Créer l\'événement')
			->visit('/event_list_orga')
			->waitForText($event_bot_name)
			->assertSee($event_bot_name)
			->assertDontSee('Whoops')
			;

			$orga2
			->visit('/login')
			->type('email', 'orga2@gmail.com')
			->type('password', 'azerty')
			->press('Login')
			->assertDontSee($event_bot_name)
			->click('#create')
			->type('nom', $event_bot_name2)
			->type('billetterie', 'https://fr.wikipedia.org/wiki/Wikip%C3%A9dia:Accueil_principal')
			->type('place', '31 Rue des Filatiers, Toulouse, France')
			->type('finHeure', '23:30')
			->type('list_performs[0]', substr(md5(mt_rand()), 0, 7))
			->press('ajouter un spectacle de plus')
			->type('list_performs[1]', substr(md5(mt_rand()), 0, 7))
			->press('ajouter un spectacle de plus')
			->type('list_performs[2]', substr(md5(mt_rand()), 0, 7))
			->press('ajouter un spectacle de plus')
			->type('list_performs[3]', substr(md5(mt_rand()), 0, 7))
			->type('textbox', substr(md5(mt_rand()), 0, 7))
			->press('Créer l\'événement')
			->waitForText($event_bot_name2)
			->assertSee($event_bot_name2)
			->assertDontSee('Whoops')
			->click('#logoutlink')
			;

			$orga
			->visit('event_list_orga')
			->assertDontSee($event_bot_name2)
			->assertDontSee('Whoops')
			->click('#logoutlink')
			;
		});

		$this->assertDatabaseHas('events', [
			'nom' => $event_bot_name
			]);
		$this->assertDatabaseHas('events', [
			'nom' => $event_bot_name2
			]);
		// test delete no fonctionel il ne capte pas le lien de validation de suppression
		// $this->browse(function($orga) use ($event_bot_name) {
		// 	$orga
		// 	->visit('/login')
		// 	->type('email', 'orga@gmail.com')
		// 	->type('password', 'azerty')
		// 	->press('Login')
		// 	->assertSee($event_bot_name)
		// 	->assertDontSee('Whoops')
		// 	->click('#deleteEvent4')
		// 	->click('#modalSubmitEvent4')
		// 	->assertDontSee($event_bot_name)
		// 	->click('#logoutlink')
		// 	;
			
		// });

		// $this->assertDatabaseHas('events', [
		// 	'nom' => $event_bot_name
		// 	]);
	}
	
	public function test2ndSenarii(){

		$randEvent = Event::find(mt_rand(1, count(Event::all())));
		$event_bot_name3 = 'eventbot3/'.substr(md5(mt_rand()), 0, 7);

$this->browse(function($orga3, $proguard) use ($randEvent, $event_bot_name3) {

	$orga3
	->visit('/')
	->type('email', 'orga2@gmail.com')
	->type('password', 'azerty')
	->press('Login')
	->click('#create')
	->type('nom', $event_bot_name3)
	->type('billetterie', 'https://fr.wikipedia.org/wiki/Wikip%C3%A9dia:Accueil_principal')
	->type('place', '7 Rue Léon Gambetta, Toulouse, France')
	->type('finHeure', '23:30')
	->type('list_performs[0]', substr(md5(mt_rand()), 0, 7))
	->press('ajouter un spectacle de plus')
	->type('list_performs[1]', substr(md5(mt_rand()), 0, 7))
	->press('ajouter un spectacle de plus')
	->type('list_performs[2]', substr(md5(mt_rand()), 0, 7))
	->press('ajouter un spectacle de plus')
	->type('list_performs[3]', substr(md5(mt_rand()), 0, 7))
	->type('textbox', substr(md5(mt_rand()), 0, 7))
	->press('Créer l\'événement')
	->waitForText($event_bot_name3)
	->assertSee($event_bot_name3)
	->assertDontSee('Whoops')
	->click('#logoutlink')
	;

	$proguard
	->visit('/')
	->type('email', 'proguard@gmail.com')
	->type('password', 'azerty')
	->press('Login')
	->click('#search')
	->assertSee($event_bot_name3)
	->visit('/event_details_proguard/'.$randEvent->id)
	->assertSee('S\'inscrire')
	->assertSee($randEvent->nom)
	->assertDontSee('Whoops')
	->click('#logoutlink')
	;
});
	}

	public function testProgardEvent(){

		$event = Event::find(2);

		$text = '';
		for($i=0; $i<10; $i++){
			$text .= substr(md5(mt_rand()), 0, mt_rand(2, 4)).' '.substr(md5(mt_rand()), 0, mt_rand(2, 6));
		}
		$this->browse(function($browser) use ($event, $text){
			$browser
			->visit('/')
			->type('email', 'proguard@gmail.com')
			->type('password', 'azerty')
			->press('Login')
			->click('#search')
			->waitForText('Détails')
			->type('nom', 'totipotent')
			->script('window.scrollTo(0, 250);')
			;

			$browser
			->click('#event'.$event->id)
			// ->click('#event2')
			->waitForText('S\'inscrire')
			->click('#event_sub_proguard')
			->type('list_places[0]', '38 Rue Kruger, Toulouse, France')
			->type('list_child_nbs[0]', mt_rand(1, 4))
			->type('list_range[0]', mt_rand(0, 15))

			// ->press('ajouter un lieu de plus')
			// ->type('list_places[1]', 'plus loin vers' . substr(md5(mt_rand()), 0, mt_rand(4, 7)))
			// ->type('list_child_nbs[1]', mt_rand(1, 4))
			// ->type('list_range[1]', mt_rand(0, 15))

			// ->type('debutDate', date("Y-m-d", $event->debut))
			// ->type('debutHeure', date('H:i', $event->debut))
			// ->type('finDate', date("Y-m-d", $event->fin))
			// ->type('finHeure', date('H:i', $event->fin))

			->type('textbox', $text)
			->press('Créer l\'annonce')
			->assertSee('Vos gardes')
			// ->waitForText('COUCOUCOUCOUCU')
			->assertSee($event->nom)
			->assertDontSee('Whoops')
			->click('#logoutlink')
			;
		});
		// $this->assertDatabaseHas('guards', [
		// 	'nom' => $event_bot_name
		// 	]);
	}

	public function testInscriptionProcultsSurProguards(){
		// need php artisan migration:reset
		$event = Event::find(2);
		$text = '';
		for($i=0; $i<10; $i++){
			$text .= substr(md5(microtime()),rand(0,26),5).' '.substr(md5(microtime()),rand(0,26),5);
		};

		$this->browse(function($proguard) use ($event, $text){

			$proguard
			->visit('/')
			->type('email', 'proguard2@gmail.com')
			->type('password', 'azerty')
			->press('Login')
			->click('#search')
			->type('nom', $event->nom)
			->script('window.scrollTo(0, 250);')
			;
			$proguard
			->click('#event'.$event->id)
			->waitForText('S\'inscrire')
			->assertSee($event->nom)
			->click('#event_sub_proguard')
			->waitForText('Mettre une annonce sur l\'événement')
			->type('list_places[0]', 'Le Busca, Toulouse, France')
			->type('list_child_nbs[0]', mt_rand(1, 4))
			->type('list_range[0]', mt_rand(0, 15))
			// ->press('ajouter un lieu de plus')
			// ->type('list_places[1]', 'plus loin vers ' . $place2)
			// ->type('list_child_nbs[1]', mt_rand(1, 4))
			// ->type('list_range[1]', mt_rand(0, 15))
			// ->type('debutDate', date("Y-m-d", $event->debut))
			// ->type('debutHeure', date('H:i', $event->debut))
			// ->type('finDate', date("Y-m-d", $event->fin))
			// ->type('finHeure', date('H:i', $event->fin))
			->type('textbox', $text)
			->press('Créer l\'annonce')
			->assertDontSee('Whoops')
			->click('#logoutlink')
			;

		});
	}

	public function testInscriptionProcultsSurProguardspart2(){

		$event = Event::find(2);
		$text = '';
		for($i=0; $i<10; $i++){
			$text .= substr(md5(microtime()),rand(0,26),5).' '.substr(md5(microtime()),rand(0,26),5);
		};

		$this->browse(function($procult, $proguard) use ($event, $text){

			$procult
			->visit('/')
			->type('email', 'procult@gmail.com')
			->type('password', 'azerty')
			->press('Login')
			->click('#search')
			->type('nom', $event->nom)
			->script('window.scrollTo(0, 250);')
			;
			$procult
			// ->waitForText('Détails')
			->click('#event'.$event->id)
			->waitForText('S\'inscrire')
			->click('.event_sub_procult')
			->assertSee('38 Rue Kruger, Toulouse, France')
			// ->type('place', '6 Rue d\'Austerlitz, Toulouse, France')

			// ->type('debutDate', date("Y-m-d", $event->debut))
			// ->type('debutHeure', date('H:i', $event->debut))
			// ->type('finDate', date("Y-m-d", $event->fin))
			// ->type('finHeure', date('H:i', $event->fin))
			->type('textbox', $text)
			->press('Envoyer la demande')
			// ->assertSee($event->nom)
			->assertDontSee('Whoops')
			->waitForText('38 Rue Kruger, Toulouse, France')
			// ->assertSee('38 Rue Kruger, Toulouse, France')
			->click('#logoutlink')
			;

		});
	}

	// public function testEditionEventOwnedAndNotOwned(){
	// 	$this->browse(function($procult, $proguard) use ($event, $text){
			
	// 	}
	// }

}
