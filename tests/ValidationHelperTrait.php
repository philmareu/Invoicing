<?php

namespace Tests;


use Invoicing\User;

trait ValidationHelperTrait
{
    public function postValidationTest($endpoint, $attribute, $data = [])
    {
        $this->validationTest('POST', $endpoint, $attribute, $data);
    }

    public function putValidationTest($endpoint, $attribute, $data = [])
    {
        $this->validationTest('PUT', $endpoint, $attribute, $data);
    }

    public function validationTest($method, $endpoint, $attribute, $data)
    {
        $response = $this->actingAs(factory(User::class)->create())
            ->json($method, $endpoint, $data)
            ->assertStatus(422);

        $this->assertArrayHasKey('errors', $response->getOriginalContent());
        $this->assertArrayHasKey($attribute, $response->getOriginalContent()['errors']);
    }
}