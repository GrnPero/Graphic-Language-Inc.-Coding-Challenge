<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Winner Model */
use App\Models\Winner;
use App\Models\Raffle;
use App\Models\RaffleEntry;

class WinnerController extends Controller {
    // Returns the Winner Selection View
    public function winnerSelection() {
        // Grab all Raffles and Raffle Entries
        $raffles = Raffle::all();
        $raffle_entries = RaffleEntry::all();

        return view('winner')->with('raffles', $raffles)->with('raffle_entries', $raffle_entries);
    }

    // Submits the winners
    public function selectWinners(Request $request) {
       dd($request->all());
    }
}
