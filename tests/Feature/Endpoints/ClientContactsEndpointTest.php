<?php

namespace Tests\Feature\Endpoints;

use Invoicing\Models\ClientContact;
use Tests\Feature\EndpointTest;

class ClientContactsEndpointTest extends EndpointTest
{
    protected $base = 'api/clients/contacts';

    protected $class = ClientContact::class;

    protected $table = 'client_contacts';
}