<?php

namespace Tests\Feature\Endpoints;

use Invoicing\Models\Task;
use Tests\Feature\EndpointTest;

class TasksEndpointTest extends EndpointTest
{
    protected $base = 'api/tasks';

    protected $class = Task::class;

    protected $table = 'tasks';
}