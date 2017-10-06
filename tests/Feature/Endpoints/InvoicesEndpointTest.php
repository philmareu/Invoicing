<?php

namespace Tests\Feature\Endpoints;

use Invoicing\Models\Invoice;
use Tests\Feature\EndpointTest;

class InvoicesEndpointTest extends EndpointTest
{
    protected $base = 'api/invoices';

    protected $class = Invoice::class;

    protected $table = 'invoices';
}