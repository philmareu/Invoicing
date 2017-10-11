<?php

namespace Tests\Feature\Settings;

use Illuminate\Support\Facades\Hash;
use Invoicing\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ValidationHelperTrait;

class AccountSettingsTest extends TestCase
{
    use RefreshDatabase, ValidationHelperTrait;

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
        $this->actingAsNewUser()
            ->call('GET', 'settings/account')
            ->assertViewHas('user');
    }

    /**
     * @test
     */
    public function user_can_update_account_settings()
    {
        $user = $this->createUser();

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
        $this->putValidationTest('settings/account', 'name');
    }

    /**
     * @test
     */
    public function updating_account_settings_requires_an_email()
    {
        $this->putValidationTest('settings/account', 'name');
    }

    /**
     * @test
     */
    public function updating_account_settings_requires_a_valid_email()
    {
        $this->putValidationTest('settings/account', 'name', ['email' => 'Not an email']);
    }

    /**
     * @test
     */
    public function updating_account_settings_requires_rate_to_be_an_integer()
    {
        $this->putValidationTest('settings/account', 'rate', ['rate' => 'Not an integer']);
    }

    /**
     * @test
     */
    public function updating_account_settings_requires_a_timezone()
    {
        $this->putValidationTest('settings/account', 'timezone');
    }

    /**
     * @test
     */
    public function updating_account_settings_requires_timezone_to_be_listed_in_list()
    {
        $this->putValidationTest('settings/account', 'timezone', ['timezone' => 'Not a timezone']);
    }
}
