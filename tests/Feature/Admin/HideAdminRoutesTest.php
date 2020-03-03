<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HideAdminRoutesTest extends TestCase
{
    /**
     * @test
     */
    function it_does_not_allow_guest_to_discover_admin_urls()
    {
        $response = $this->get('admin/invalid_url')
                    ->assertStatus(302)
                    ->assertRedirect('login');
    }

    function it_does_not_allow_guest_to_discover_admin_urls_using_posts()
    {
        $response = $this->post('admin/invalid_url')
                    ->assertStatus(302)
                    ->assertRedirect('login');
    }

    function it_displays_404s_when_admins_visit_invalid_urls()
    {
        $admin = factory(User::class)->create(['admin' => true]);

        $response = $this->actingAs($admin)
                    ->get('admin/invalid_url')
                    ->assertStatus(404);
    }
}
