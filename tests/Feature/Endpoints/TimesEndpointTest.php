<?php

namespace Tests\Feature\Endpoints;

use Invoicing\Models\Time;
use Tests\Feature\EndpointTest;

class TimesEndpointTest extends EndpointTest
{
    protected $base = 'api/times';

    protected $class = Time::class;

    protected $table = 'times';
}