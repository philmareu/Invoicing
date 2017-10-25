<?php

namespace Tests\Feature;

use Invoicing\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ValidationHelperTrait;

class InstallTest extends TestCase
{
    use RefreshDatabase, ValidationHelperTrait;

    /**
     * @test
     */
    public function visitor_redirected_to_install_page_when_the_users_table_is_empty()
    {
        $this->call('GET', 'login')->assertRedirect('install');
    }

    /**
     * @test
     */
    public function install_page_can_not_be_reached_if_user_table_is_not_empty()
    {
        $this->createUser();

        $this->call('GET', 'install')->assertRedirect('login');
    }

    /**
     * @test
     */
    public function installation_data_can_only_be_stored_if_the_users_table_is_empty()
    {
        $this->createUser();

        $this->call('POST', 'install')->assertRedirect('login');
    }

    /**
     * @test
     */
    public function install_page_loads_when_the_users_table_is_empty()
    {
        $this->call('GET', 'install')->assertViewIs('install');
    }

    /**
     * @test
     */
    public function installation_stores_a_new_user()
    {
        $data = [
            'name' => 'Test McTesterson',
            'email' => 'test@test.com',
            'password' => 'testing',
            'timezone' => 'American/Chicago',
            'company' => 'Test Co.'
        ];

        $this->call('POST', 'install', $data);

        $this->assertDatabaseHas('users', array_except($data, ['company', 'password']));
    }

    /**
     * @test
     */
    public function installation_stores_new_invoice_settings()
    {
        $data = [
            'name' => 'Test McTesterson',
            'email' => 'test@test.com',
            'password' => 'testing',
            'timezone' => 'American/Chicago',
            'company' => 'Test Co.'
        ];

        $this->call('POST', 'install', $data);

        $this->assertDatabaseHas('invoice_settings', array_only($data, ['company']));
    }

    /**
     * @test
     */
    public function successful_installation_will_redirect_user()
    {
        $data = [
            'name' => 'Test McTesterson',
            'email' => 'test@test.com',
            'password' => 'testing',
            'timezone' => 'American/Chicago',
            'company' => 'Test Co.'
        ];

        $response = $this->call('POST', 'install', $data)->assertRedirect('/');
    }

    /**
     * @test
     */
    public function storing_installation_data_requires_an_email()
    {

    }

    /**
     * @test
     */
    public function storing_installation_data_requires_a_password()
    {

    }

    /**
     * @test
     */
    public function storing_installation_data_requires_a_timezone()
    {

    }

    /**
     * @test
     */
    public function storing_installation_data_the_email_must_be_valid()
    {

    }

    /**
     * @test
     */
    public function storing_installation_data_the_timezone_must_be_valid()
    {

    }
}
