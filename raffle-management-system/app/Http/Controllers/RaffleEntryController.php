<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// RaffleEntry Model
use App\Models\RaffleEntry;

class RaffleEntryController extends Controller
{
    // User submits the raffle to the database
    public function submitRaffleEntry(Request $request) {
        $raffle_entry = RaffleEntry::create([

        ]);

        $raffle_entry->save();

        return response()->json("Successfully submitted");
    }
}