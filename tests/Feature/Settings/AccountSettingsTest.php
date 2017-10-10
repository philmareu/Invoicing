<?php

namespace Tests\Feature\Settings;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Invoicing\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountSettingsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function guests_can_not_view_account_settings_page()
    {
        $this->call('GET', 'settings/account')->assertRedirect('login');
    }

    /**
     * @test
     */
    public function guests_can_not_update_account_settings()
    {
        $this->call('PUT', 'settings/account')->assertRedirect('login');
    }

    /**
     * @test
     */
    public function account_settings_page_loads_with_data()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)
            ->call('GET', 'settings/account')
            ->assertViewHas('user');
    }

    /**
     * @test
     */
    public function user_can_update_account_settings()
    {
        $user = factory(User::class)->create();

        $data = [
            'name' => 'test-' . $user->name,
            'email' => 'test-' . $user->email,
            'rate' => $user->rate + 1,
            'timezone' => $user->timezone == 'America/Chicago' ? 'America/Anchorage' : 'America/Chicago',
            'password' => 'new_password'
        ];

        $this->actingAs($user)
            ->call('PUT', 'settings/account', $data);

        $user = User::find($user->id);

        $this->assertEquals($data['name'], $user->name);
        $this->assertEquals($data['email'], $user->email);
        $this->assertEquals($data['rate'], $user->rate);
        $this->assertEquals($data['timezone'], $user->timezone);
        $this->assertTrue(Hash::check($data['password'], $user->password));
    }

    /**
     * @test
     */
    public function updating_account_settings_requires_a_name()
    {
        $this->actingAs(factory(User::class)->create())
            ->call('PUT', 'settings/account')
            ->assertSessionHasErrors('name');
    }

    /**
     * @test
     */
    public function updating_account_settings_requires_an_email()
    {
        $this->actingAs(factory(User::class)->create())
            ->call('PUT', 'settings/account')
            ->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function updating_account_settings_requires_a_valid_email()
    {
        $this->actingAs(factory(User::class)->create())
            ->call('PUT', 'settings/account', ['email' => 'Not an email'])
            ->assertSessionHasErrors('email');
    }

    /**
     * @test
     */
    public function updating_account_settings_requires_rate_to_be_an_integer()
    {
        $this->actingAs(factory(User::class)->create())
            ->call('PUT', 'settings/account', ['rate' => 'Not an integer'])
            ->assertSessionHasErrors('rate');
    }

    /**
     * @test
     */
    public function updating_account_settings_requires_a_timezone()
    {
        $this->actingAs(factory(User::class)->create())
            ->call('PUT', 'settings/account')
            ->assertSessionHasErrors('timezone');
    }

    /**
     * @test
     */
    public function updating_account_settings_requires_timezone_to_be_listed_in_list()
    {
        $this->actingAs(factory(User::class)->create())
            ->call('PUT', 'settings/account', ['timezone' => 'Not a timezone'])
            ->assertSessionHasErrors('timezone');
    }
}
