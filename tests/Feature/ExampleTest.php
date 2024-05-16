<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        //Create a user to pass login auth
        $user = User::factory()->make();
        Auth::login($user);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
