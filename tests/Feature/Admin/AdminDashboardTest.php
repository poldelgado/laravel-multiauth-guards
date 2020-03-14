<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    /** @test */
    function admins_can_visit_the_admin_dashboard()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAsAdmin()
                        ->get(route('admin_dashboard'))
                        ->assertStatus(200)
                        ->assertSee('Admin Panel');
    }

    /** @test */
    function non_admin_users_cannot_visit_the_admin_dashboard()
    {
        $response = $this->actingAsUser()
                        ->get(route('admin_dashboard'))
                        ->assertStatus(302)
                        ->assertRedirect('login');
    }

    /** @test */
    function guests_cannot_visit_the_admin_dashboard()
    {
        $response = $this->get(route('admin_dashboard'))
                        ->assertStatus(302)
                        ->assertRedirect('login');
    }

}
