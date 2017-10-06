<?php

namespace Tests\Feature\Endpoints;

use Invoicing\Models\InvoiceItem;
use Tests\Feature\EndpointTest;

class InvoiceItemsEndpointTest extends EndpointTest
{
    protected $base = 'api/invoices/items';

    protected $class = InvoiceItem::class;

    protected $table = 'invoice_items';
}