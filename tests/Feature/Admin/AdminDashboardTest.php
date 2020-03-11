<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\{User, Admin};

class AdminDashboardTest extends TestCase
{
    /** @test */
    function admins_can_visit_the_admin_dashboard()
    {
        $this->withoutExceptionHandling();

        $response = $this->actingAs($this->createAdmin(), 'admin')
                        ->get(route('admin_dashboard'))
                        ->assertStatus(200)
                        ->assertSee('Admin Panel');
    }

    /** @test */
    function non_admin_users_cannot_visit_the_admin_dashboard()
    {
        $response = $this->actingAs($this->createUser())
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

    protected function createAdmin()
    {
       return factory(Admin::class)->create();
    }

    protected function createUser()
    {
       return factory(User::class)->create();
    }
}
