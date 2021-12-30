<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaffleEntry extends Model
{
    use HasFactory;

    // What can be User input
    protected $fillable = [
        'full_name',
        'phone_number',
        'raffle_id',
        'raffle_entry_id',
        'is_valid'
    ];
}
