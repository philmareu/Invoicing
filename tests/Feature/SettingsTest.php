<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SettingsTest extends TestCase
{
    /**
     * @test
     */
    public function the_settings_page_loads_with_all_default_settings_from_database()
    {
        $this->call('GET', 'settings')
            ->assertStatus(200)
            ->assertViewHas('settings', [
                'rate' => null,
                'email' => null,
                'address_1' => null,
                'address_2' => null,
                'city' => null,
                'state' => null,
                'zip' => null,
                'phone' => null,
                'note' => null,
                'stripe_public' => null,
                'stripe_secret' => null,
                'timezone' => 'America/Chicago'
            ]);
    }
}
