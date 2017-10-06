<?php

namespace Tests\Feature\Endpoints;

class DeleteSettingsEndpointTest extends SettingsEndpointTest
{
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
        $specimen = $this->createManyReturnRandom($this->class);

        $this->actingAsNewUser()
            ->json('DELETE', implode('/', [$this->base, $specimen->id]))
            ->assertStatus(200);

        $this->assertDatabaseMissing($this->table, ['id' => $specimen->id]);
    }
}
