<?php
namespace Tests\Feature\Endpoints;

class DeleteClientContactsEndpointTest extends ClientContactsEndpointTest
{
    /**
     * @test
     */
    public function guests_can_not_reach_delete_client_contacts_endpoint()
    {
        $this->json('DELETE', $this->attachIdToBase())->assertStatus(401);
    }

    /**
     * @test
     */
    public function user_can_delete_a_client_contact()
    {
        $specimen = $this->createManyReturnRandom($this->class);

        $this->actingAsNewUser()
            ->json('DELETE', implode('/', [$this->base, $specimen->id]))
            ->assertStatus(200);

        $this->assertDatabaseMissing($this->table, ['id' => $specimen->id]);
    }
}
