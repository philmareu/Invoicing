<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PageLoadTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function clients_page_loads()
    {
        $this->call('GET', 'clients')->assertRedirect('login');
        $this->actingAsNewUser()->call('GET', 'clients')->assertStatus(200);
    }
}
