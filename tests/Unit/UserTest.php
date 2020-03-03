<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{
   /** @test */
   function a_user_can_be_an_admin()
   {
       use RefreshDatabase;

       $user = factory(User::class)->create(['admin' => true]);

       $this->assertFalse($user->admin);

       $user->admin = true;

       $user->save();

       $this->assertTrue($user->admin);
   }
}
