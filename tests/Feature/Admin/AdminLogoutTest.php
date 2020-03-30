<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class AdminLogoutTest extends TestCase
{
    /** @test */
    function  an_admin_can_logout()
    {
        // Creo precondiciones de la prueba
        $admin = $this->createAdmin();

        auth('admin')->login($admin);

        $this->assertAuthenticated('admin');

        // Respuesta de la prueba
        $response = $this->post('admin/logout');

        // Assert de la prueba
        $response->assertRedirect('/');

        $this->assertGuest('admin'); //Verifico que no este nadie conectado con guard admin
    }

    /** @test */
    function  logging_out_as_an_admin_does_not_terminate_the_user_session()
    {
        // Creo precondiciones de la prueba

        auth('admin')->login($this->createAdmin());
        auth('web')->login($this->createUser());

        //Busco nombres de sesiones
        $adminSessionName = auth('admin')->getName();
        $webSessionName = auth('web')->getName();


        $this->assertAuthenticated('admin');
        $this->assertAuthenticated('web');

        // Respuesta de la prueba
        $response = $this->post('admin/logout');

        // Assert de la prueba
        $response->assertRedirect('/')
            ->assertSessionHas($webSessionName)
            ->assertSessionMissing($adminSessionName);

        $this->assertGuest('admin'); //Verifico que no este nadie conectado con guard admin
        $this->assertAuthenticated('web');//Verifico que el usuario siga conectado

    }

}
