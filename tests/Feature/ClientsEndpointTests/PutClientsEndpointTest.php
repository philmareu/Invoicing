<?php

namespace Tests\Feature\ClientsEndpointTests;

use Invoicing\Models\Client;
use Invoicing\User;
use Tests\Feature\EndpointTest;

class PutClientsEndpointTest extends EndpointTest
{
    protected $base = 'api/clients';

    protected $class = Client::class;

    /**
     * @test
     */
    public function guests_can_not_reach_put_clients_endpoint()
    {
        $this->json('PUT', $this->attachIdToBase())->assertStatus(401);
    }

    /**
     * @test
     */
    public function user_can_update_a_client()
    {
        $clients = factory(Client::class, 10)->create();

        $specimen = $clients->random();
        $newAttributes = factory(Client::class)->make();

        $this->actingAs(factory(User::class)->create())
            ->json('PUT', $this->base . '/' . $specimen->id, $newAttributes->toArray())
            ->assertJson($newAttributes->toArray());

        $this->assertArraySubset(
            $newAttributes->toArray(),
            Client::find($specimen->id)->toArray()
        );
    }

    /**
     * @test
     */
    public function updating_a_client_requires_a_title()
    {
        $this->putValidationTest($this->attachIdToBase(), 'title');
    }

    /**
     * @test
     */
    public function updating_a_client_requires_an_email()
    {
        $this->putValidationTest($this->attachIdToBase(), 'email');
    }

    /**
     * @test
     */
    public function updating_a_client_requires_a_valid_email()
    {
        $this->putValidationTest($this->attachIdToBase(), 'email', ['email' => 'not an email']);
    }
}
