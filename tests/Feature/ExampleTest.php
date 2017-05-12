<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     *
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }*/

    public function testBasicExample()
    {
        $name= 'Dulio Palacios';
        $user = factory(\App\User::class)->create(['name'=>$name,]);

        $this->actingAs($user,'api')
            ->visit('api/user')
             ->see($name);
    }
}
