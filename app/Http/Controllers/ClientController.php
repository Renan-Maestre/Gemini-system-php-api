<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Http\Resources\ClientResource;
use Illuminate\Support\Facades\Gate;
use App\Models\Client;

/**
 * @method authorize(string $string, Client $client)
 */
class ClientController extends Controller
{
    public function index()
    {
        return ClientResource::collection(auth()->user()->clients);
    }

    public function store(storeClientRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();

        $client = Client::create($data);
        return new ClientResource($client);
    }

    public function show($uuid)
    {
        $client = auth()->user()->clients()->where('uuid', $uuid)->firstOrFail();
        return new ClientResource($client);
    }

    public function update(UpdateClientRequest $request, $uuid)
    {
        $client = Client::where('uuid', $uuid)->firstOrFail();


        Gate::authorize('update', $client);

        $client->update($request->validated());
        return new ClientResource($client);
    }

    public function destroy($uuid)
    {
        $client = Client::where('uuid', $uuid)->firstOrFail();
        $client->delete();
        return response()->json(['message' => 'Cliente removido com sucesso']);
    }
}
