<?php

namespace Tests\Feature\Endpoints;

use Invoicing\Models\Client;
use Tests\Feature\EndpointTest;

class ClientsEndpointTest extends EndpointTest
{
    protected $base = 'api/clients';

    protected $class = Client::class;

    protected $table = 'clients';
}