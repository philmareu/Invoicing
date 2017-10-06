<?php

namespace Tests\Feature\Endpoints;

use Invoicing\Models\Note;
use Tests\Feature\EndpointTest;

class NotesEndpointTest extends EndpointTest
{
    protected $base = 'api/notes';

    protected $class = Note::class;

    protected $table = 'notes';
}