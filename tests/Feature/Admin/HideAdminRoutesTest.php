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
                    ->assertRedirect('admin/login');
    }

    /**
     * @test
     */
    function it_does_not_allow_guest_to_discover_admin_urls_using_posts()
    {
        $response = $this->post('admin/invalid_url')
                    ->assertStatus(302)
                    ->assertRedirect('admin/login');
    }

    /**
     * @test
     */
    function it_displays_404s_when_admins_visit_invalid_urls()
    {
        $response = $this->actingAsAdmin()
                    ->get('admin/invalid_url')
                    ->assertStatus(404);
    }
}
