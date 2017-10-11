<?php

namespace Tests\Feature\ClientsEndpointTests;

use Invoicing\Models\Client;
use Tests\Feature\Endpoints\ClientsEndpointTest;

class PutClientsEndpointTest extends ClientsEndpointTest
{
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
        $client = $this->createResource();

        $data = [
            'title' => 'test-' . $client->name,
            'email' => 'test-' . $client->email,
            'address_1' => 'test-' . $client->address_1,
            'address_2' => 'test-' . $client->address_2,
            'city' => 'test-' . $client->city,
            'state' => 'XX',
            'zip' => 'test-' . $client->zip,
            'phone' => 'test-' . $client->phone
        ];

        $this->actingAsNewUser()
            ->json('PUT', $this->base . '/' . $client->id, $data)
            ->assertJson($data);

        $client = $this->findResourceById($client->id);

        $this->assertEquals($data['title'], $client->title);
        $this->assertEquals($data['email'], $client->email);
        $this->assertEquals($data['address_1'], $client->address_1);
        $this->assertEquals($data['address_2'], $client->address_2);
        $this->assertEquals($data['city'], $client->city);
        $this->assertEquals($data['state'], $client->state);
        $this->assertEquals($data['zip'], $client->zip);
        $this->assertEquals($data['phone'], $client->phone);
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
