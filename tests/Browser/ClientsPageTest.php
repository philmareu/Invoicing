<?php

namespace Tests\Browser;

use Invoicing\Models\Client;
use Tests\Browser\Pages\ClientsPage;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ClientsPageTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function clients_vue_component_has_a_list_of_clients()
    {
        $clients = factory(Client::class, 3)->create();

        $this->browse(function (Browser $browser) use ($clients) {
            $browser->loginAs($this->createUser())
                ->visit(new ClientsPage)
                ->waitFor('td.title')
                ->assertVue('clients', $clients->toArray(), '@clients-component');
        });
    }

    /**
     * @test
     */
    public function user_can_create_a_client()
    {
        $attributes = factory(Client::class)->make()->toArray();

        $this->browse(function(Browser $browser) use ($attributes) {
            $browser->loginAs($this->createUser())
                ->visit(new ClientsPage)
                ->createClient($attributes)
                ->waitFor('td.title');

            $this->assertEquals($attributes['title'], $browser->text('td.title'));
        });
    }

    /**
     * @test
     */
    public function user_can_edit_a_client()
    {
        $client = factory(Client::class)->create();

        $attributes = [
            'title' => 'test-' . $client->name,
            'email' => 'test-' . $client->email,
            'address_1' => 'test-' . $client->address_1,
            'address_2' => 'test-' . $client->address_2,
            'city' => 'test-' . $client->city,
            'state' => 'XX',
            'zip' => 'test-' . $client->zip,
            'phone' => 'test-' . $client->phone
        ];

        $this->browse(function(Browser $browser) use ($attributes) {
            $browser->loginAs($this->createUser())
                ->visit(new ClientsPage)
                ->editClient($attributes)
                ->waitFor('td.title');

            $this->assertEquals($attributes['title'], $browser->text('td.title'));
        });
    }
}
