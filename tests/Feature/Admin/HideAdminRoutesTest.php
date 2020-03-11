<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Admin;

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

    /**
     * @test
     */
    function it_does_not_allow_guest_to_discover_admin_urls_using_posts()
    {
        $response = $this->post('admin/invalid_url')
                    ->assertStatus(302)
                    ->assertRedirect('login');
    }

    /**
     * @test
     */
    function it_displays_404s_when_admins_visit_invalid_urls()
    {
        $response = $this->actingAs($this->createAdmin(), 'admin')
                    ->get('admin/invalid_url')
                    ->assertStatus(404);
    }

    protected function createAdmin()
    {
       return factory(Admin::class)->create();
    }
}
