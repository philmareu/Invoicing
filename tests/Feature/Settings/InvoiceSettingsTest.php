<?php

namespace Tests\Feature\Settings;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\ValidationHelperTrait;

class InvoiceSettingsTest extends TestCase
{
    use RefreshDatabase, ValidationHelperTrait;

    /**
     * Base URI
     *
     * @var string
     */
    protected $base = 'settings/invoice';

    /**
     * @test
     */
    public function guests_can_not_view_invoice_settings_page()
    {
        $this->call('GET', $this->base)->assertRedirect('login');
    }

    /**
     * @test
     */
    public function guests_can_not_update_invoice_settings()
    {
        $this->call('PUT', $this->base)->assertRedirect('login');
    }

    /**
     * @test
     */
    public function invoice_settings_page_loads_with_data()
    {
        $this->actingAsNewUser()
            ->call('GET', $this->base)
            ->assertViewHas('settings');
    }

    /**
     * @test
     */
    public function user_can_update_invoice_settings()
    {
        $user = $this->createUser();

        $data = [
            'company' => 'Test Co.',
            'email' => 'email@email.com',
            'address_1' => '1234 Street',
            'address_2' => 'Suite A',
            'city' => 'Lawrence',
            'state' => 'KS',
            'zip' => '62009',
            'phone' => '123-123-1234',
            'note' => 'Due in 30 days',
        ];

        $this->actingAs($user)
            ->call('PUT', $this->base, $data);

        $this->assertDatabaseHas('invoice_settings', $data);
    }

    /**
     * @test
     */
    public function updating_invoice_settings_require_a_company()
    {
        $this->putValidationTest($this->base, 'company');
    }

    /**
     * @test
     */
    public function updating_invoice_settings_require_a_email()
    {
        $this->putValidationTest($this->base, 'email');
    }

    /**
     * @test
     */
    public function updating_invoice_settings_the_email_must_be_a_valid_email()
    {
        $this->putValidationTest($this->base, 'email', ['Not an email']);
    }
}
