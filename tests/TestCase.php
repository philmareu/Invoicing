<?php

namespace Tests;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Invoicing\User;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Create a new user
     *
     * @return User
     */
    protected function createUser()
    {
        return factory(User::class)->create();
    }

    /**
     * Make a call on behalf of a newly created and authenticated user
     *
     * @return $this
     */
    protected function actingAsNewUser()
    {
        return $this->actingAs($this->createUser());
    }

    /**
     * Create a given number of resources and return one at random
     *
     * @param string $class
     * @param int $quantity
     *
     * @return Model
     */
    protected function createManyReturnRandom($class, $quantity = 10)
    {
        return factory($class, $quantity)->create()->random();
    }
}
