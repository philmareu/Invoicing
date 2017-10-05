<?php

namespace Tests\Feature\ClientsEndpointTests;

use Invoicing\Models\Client;
use Invoicing\User;
use Tests\Feature\EndpointTest;

class GetClientsEndpointTest extends EndpointTest
{
    protected $base = 'api/clients';

    protected $class = Client::class;

    /**
     * @test
     */
    public function guests_can_not_reach_get_clients_endpoint()
    {
        $this->json('GET', $this->base)->assertStatus(401);
    }

    /**
     * @test
     */
    public function get_clients_endpoint_should_return_a_list_of_all_clients()
    {
        $clients = factory(Client::class, 2)->create();

        $this->actingAs(factory(User::class)->create())
            ->json('GET', $this->base)
            ->assertExactJson($clients->toArray());
    }
}
