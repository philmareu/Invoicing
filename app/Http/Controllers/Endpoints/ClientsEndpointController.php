<?php

namespace Invoicing\Http\Controllers\Endpoints;

use Illuminate\Http\Request;
use Invoicing\Http\Controllers\Controller;
use Invoicing\Http\Requests\Endpoints\StoreClientEndpointRequest;
use Invoicing\Http\Requests\Endpoints\StoreClientRequest;
use Invoicing\Http\Requests\Endpoints\UpdateClientRequest;
use Invoicing\Models\Client;

class ClientsEndpointController extends Controller
{
    protected $client;

    public function __construct(Client $client)
    {
        $this->middleware('auth');
        $this->client = $client;
    }

    public function get()
    {
        return $this->client->all();
    }

    public function store(StoreClientRequest $request)
    {
        return $this->client->create($request->all());
    }

    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->all());

        return $client;
    }

    public function destroy(Client $client)
    {
        $client->delete();
    }
}
