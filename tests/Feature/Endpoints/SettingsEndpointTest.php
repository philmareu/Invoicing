<?php

namespace Tests\Feature\Endpoints;

use Invoicing\Models\Setting;
use Tests\Feature\EndpointTest;

class SettingsEndpointTest extends EndpointTest
{
    protected $base = 'api/settings';

    protected $class = Setting::class;

    protected $table = 'settings';
}