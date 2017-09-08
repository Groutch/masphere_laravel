<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
    	$this->assertTrue(true);
    }
    
    public function testUnauthentifiedTest()
    {
    	$response = $this->get('/');
    	$response->assertStatus(302);
    	$response->assertRedirect('/login');
    }

    public function testAdminExists()
    {
    	$this->assertDatabaseHas('users', [
    		'email' => 'procult@gmail.com'
    		]);
    }
}
