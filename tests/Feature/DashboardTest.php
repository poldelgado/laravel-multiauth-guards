<?php

namespace Tests\Feature;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class DashboardTest extends TestCase
{
    /** @test **/
    function it_shows_the_dashboard()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)
                    ->get(route('home'))
                    ->assertStatus(200);

    }

     /** @test **/
     function it_redirects_guest_users_to_the_login_page()
     {
        $response = $this->get(route('home'))
                    ->assertStatus(302)
                    ->assertRedirect('login');
     }
}
