<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::with('address')->get();
        return response()->json($clients);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClientRequest $request)
    {
        $validated = $request->validated();

        try {

            $client = DB::transaction(function () use ($validated) {
                $client = Client::create([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                    'cnpj' => $validated['cnpj'],
                    'observation' => $validated['observation'] ?? null,
                    'contract_value' => $validated['contract_value'],
                ]);

                $client->address()->create($validated['address']);
                return $client->load('address');
            });

            return response()->json($client, 201);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create client',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
