<?php

namespace Tests\Feature\Endpoints;

class PostClientsEndpointTest extends ClientsEndpointTest
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

    /**
     * @test
     */
    public function storing_a_client_requires_a_title()
    {
        $this->postValidationTest($this->base, 'title');
    }

    /**
     * @test
     */
    public function storing_a_client_requires_an_email()
    {
        $this->postValidationTest($this->base, 'email');
    }

    /**
     * @test
     */
    public function storing_a_client_requires_a_valid_email()
    {
        $this->postValidationTest($this->base, 'email', ['email' => 'not an email']);
    }
}
