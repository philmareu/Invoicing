<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ConsoleCreateUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function console_command_should_create_a_new_user()
    {
        Artisan::call('user:create user@user.com password');

        $this->assertTrue(Auth::validate(['email' => 'user@user.com', 'password' => 'password']));
    }
}
