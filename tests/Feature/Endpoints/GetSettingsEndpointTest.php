<?php

namespace Tests\Feature\Endpoints;

class GetSettingsEndpointTest extends SettingsEndpointTest
{
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
        $resources = factory($this->class, 2)->create();

        $this->actingAsNewUser()
            ->json('GET', $this->base)
            ->assertExactJson($resources->toArray());
    }
}
