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
	public function testLoginSee()
	{
		$this->browse(function (Browser $browser) {
			$browser
			->visit('/login')
			->assertSee('Password');
		});
	}

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
	
	public function test2ndSenarii(){

		$randEvent = Event::find(mt_rand(1, count(Event::all())));
		$event_bot_name3 = 'eventbot3/'.substr(md5(mt_rand()), 0, 7);

		$this->browse(function($orga3, $proguard) use ($randEvent, $event_bot_name3) {

			$orga3
			->visit('/login')
			->type('email', 'orga2@gmail.com')
			->type('password', 'azerty')
			->press('Login')
			->visit('/event_creation')
			->type('nom', $event_bot_name3)
			->type('place', substr(md5(mt_rand()), 0, 7))
			->type('list_performs[0]', substr(md5(mt_rand()), 0, 7))
			->press('ajouter un spectacle de plus')
			->type('list_performs[1]', substr(md5(mt_rand()), 0, 7))
			->press('ajouter un spectacle de plus')
			->type('list_performs[2]', substr(md5(mt_rand()), 0, 7))
			->press('ajouter un spectacle de plus')
			->type('list_performs[3]', substr(md5(mt_rand()), 0, 7))
			->press('Créer l\'événement')
			->waitForText($event_bot_name3)
			->assertDontSee('Whoops')
			;

			$proguard
			->visit('/login')
			->type('email', 'proguard@gmail.com')
			->type('password', 'azerty')
			->press('Login')
			->visit('/event_search')
			->assertSee($event_bot_name3)
			->visit('/event_details_proguard/'.$randEvent->id)
			->assertSee('S\'inscrire')
			->assertSee($randEvent->nom)
			->assertDontSee('Whoops')
			;
		});
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
