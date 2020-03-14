<?php

namespace Tests;
use App\Admin;
use App\User;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function actingAsAdmin($admin = null)
    {
        if ($admin == null) {
            $admin = $this->createAdmin();
        }

        return $this->actingAs($admin, 'admin');
    }

    protected function actingAsUser($user = null)
    {
        if ($user == null) {
            $user = $this->createUser();
        }

        return $this->actingAs($user);
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


