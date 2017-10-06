<?php

namespace Tests\Feature\Endpoints;

use Invoicing\Models\WorkOrder;
use Tests\Feature\EndpointTest;

class WorkOrdersEndpointTest extends EndpointTest
{
    protected $base = 'api/work_orders';

    protected $class = WorkOrder::class;

    protected $table = 'work_orders';
}