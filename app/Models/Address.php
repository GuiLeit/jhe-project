<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    /** @use HasFactory<\Database\Factories\AddressFactory> */
    use HasFactory;

    protected $fillable = [
        'client_id',
        'street',
        'number',
        'postal_code',
        'complement',
        'neighborhood',
        'city',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
