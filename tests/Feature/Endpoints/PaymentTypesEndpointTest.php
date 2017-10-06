<?php

namespace Tests\Feature\Endpoints;

use Invoicing\Models\PaymentType;
use Tests\Feature\EndpointTest;

class PaymentTypesEndpointTest extends EndpointTest
{
    protected $base = 'api/payments/types';

    protected $class = PaymentType::class;

    protected $table = 'payment_types';
}