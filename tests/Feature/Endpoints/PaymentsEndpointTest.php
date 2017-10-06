<?php

namespace Tests\Feature\Endpoints;

use Invoicing\Models\Payment;
use Tests\Feature\EndpointTest;

class PaymentsEndpointTest extends EndpointTest
{
    protected $base = 'api/payments';

    protected $class = Payment::class;

    protected $table = 'payments';
}