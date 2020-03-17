<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function login_in_as_an_admin()
    {
        $this->withoutExceptionHandling();

        $email = 'admin@cam.net';
        $password = 'mamadera';

        $admin = $this->createAdmin([
            'email' => $email,
            'password' => bcrypt($password),
        ]);
        $this->post(route('admin.login'), compact('email', 'password'));

        $this->assertAuthenticatedAs($admin, 'admin'); //Verifico que el usuario admin este autenticado en el guard admin.
    }
}
