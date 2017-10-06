<?php

namespace Tests\Feature\Endpoints;

class PostInvoiceItemsEndpointTest extends InvoiceItemsEndpointTest
{
    /**
     * @test
     */
    public function guests_can_not_reach_post_clients_endpoint()
    {
        $this->json('POST', $this->base)->assertStatus(401);
    }

    /**
     * @test
     */
    public function user_can_store_a_new_client()
    {
        $client = factory($this->class)->make();

        $this->actingAsNewUser()
            ->json('POST', $this->base, $client->toArray())
            ->assertJson($client->toArray());

        $this->assertDatabaseHas($this->table, $client->toArray());
    }
}
