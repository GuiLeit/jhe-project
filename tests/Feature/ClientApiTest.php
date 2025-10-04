<?php

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Client;

uses(RefreshDatabase::class);

test('it_creates_a_client_with_address_successfully', function () {
    $payload = [
        'name' => 'Test Client',
        'email' => 'test@example.com',
        'cnpj' => '12345678901234',
        'observation' => 'Test observation',
        'contract_value' => 10000.99,
        'address' => [
            'street' => 'Main St',
            'number' => '123',
            'postal_code' => '12345-678',
            'complement' => 'Apt 1',
            'neighborhood' => 'Downtown',
            'city' => 'Test City',
        ]
    ];

    $response = $this->postJson('/api/clients', $payload);

    $response->assertStatus(201)
            ->assertJsonStructure([
                'id',
                'name',
                'email',
                'cnpj',
                'observation',
                'contract_value',
                'address' => [
                    'id',
                    'street',
                    'number',
                    'postal_code',
                    'complement',
                    'neighborhood',
                    'city',
                    'client_id'
                ]
            ])
            ->assertJson([
                'name' => 'Test Client',
                'email' => 'test@example.com',
                'cnpj' => '12345678901234',
                'address' => [
                    'street' => 'Main St',
                    'city' => 'Test City',
                ]
            ]);

    $this->assertDatabaseHas('clients', [
        'name' => 'Test Client',
        'email' => 'test@example.com',
        'cnpj' => '12345678901234',
    ]);
    
    $this->assertDatabaseHas('addresses', [
        'street' => 'Main St',
        'city' => 'Test City',
        'client_id' => $response->json('id')
    ]);

    $client = Client::find($response->json('id'));
    expect($client->address)->not->toBeNull();
    expect($client->address->street)->toBe('Main St');
});

test('it_validates_required_client_fields', function () {
    $payload = [
        'email' => 'invalid-email',
    ];

    $response = $this->postJson('/api/clients', $payload);

    $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'name',
                'email',
                'cnpj',
                'contract_value',
                'address'
            ]);
});

test('it_validates_required_address_fields', function () {
    $payload = [
        'name' => 'Test Client',
        'email' => 'test@example.com',
        'cnpj' => '12345678901234',
        'contract_value' => 10000,
        'address' => [
            'street' => 'Main St',
            // Missing required fields: number, postal_code, neighborhood, city
        ]
    ];

    $response = $this->postJson('/api/clients', $payload);

    $response->assertStatus(422)
             ->assertJsonValidationErrors([
                 'address.number',
                 'address.postal_code',
                 'address.neighborhood',
                 'address.city'
             ]);
});

