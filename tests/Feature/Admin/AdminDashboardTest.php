<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class AdminDashboardTest extends TestCase
{
    /** @test */
    function admins_can_visit_the_admin_dashboard()
    {
        $admin = factory(User::class)->create(['admin' => true]);

        $response = $this->actingAs($admin)
                        ->get(route('admin_dashboard'))
                        ->assertStatus(200)
                        ->assertSee('Admin Panel');
    }

    /** @test */
    function non_admin_users_cannot_visit_the_admin_dashboard()
    {
        $user = factory(User::class)->create(['admin'=>false]);

        $response = $this->actingAs(($user))
                        ->get(route('admin_dashboard'))
                        ->assertStatus(403);
    }

    /** @test */
    function guests_cannot_visit_the_admin_dashboard()
    {
        $response = $this->get(route('admin_dashboard'))
                        ->assertStatus(302)
                        ->assertRedirect('login');
    }
}
