<?php

namespace Tests\Feature\ClientsEndpointTests;

use Invoicing\Models\Client;
use Invoicing\User;
use Tests\Feature\EndpointTest;

class DeleteClientsEndpointTest extends EndpointTest
{
    protected $base = 'api/clients';

    protected $class = Client::class;

    /**
     * @test
     */
    public function guests_can_not_reach_delete_clients_endpoint()
    {
        $this->json('DELETE', $this->attachIdToBase())->assertStatus(401);
    }

    /**
     * @test
     */
    public function user_can_delete_a_client()
    {
        $clients = factory(Client::class, 10)->create();

        $specimen = $clients->random();

        $this->actingAs(factory(User::class)->create())
            ->json('DELETE', $this->base . '/' . $specimen->id)
            ->assertStatus(200);

        $this->assertDatabaseMissing('clients', ['id' => $specimen->id]);
    }
}
