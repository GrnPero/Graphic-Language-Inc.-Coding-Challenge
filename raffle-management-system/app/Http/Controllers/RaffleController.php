<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/* Models */
use App\Models\Raffle;

class RaffleController extends Controller
{
    // Returns all raffles
    public function getRaffles() {
        return $raffles = Raffle::all();
    }

    // Returns all the raffles to the page
    public function getAllRafflesHomePage() {
        // Return it as a dropdown menu on the homepage
        return view('index')->with('raffles', $this->getRaffles());
    }

    // Returns all raffles to the raffle-creation page
    public function getAllRaffles() {
        return view('raffle')->with('raffles', $this->getRaffles());
    }

    // Submits Raffle to the database
    public function submitRaffle(Request $request) {
        // Grabs the raffle name and numOfWinners from the request
        $name = $request->input('raffle_name');
        $winners = $request->input('numOfWinners');

        // Create the raffle
        $raffle = Raffle::create([
            'name' => $name,
            'winners' => $winners
        ]);

        // Save it to the database
        $raffle->save();

        // Return json response
        return response()->json($raffle);
    }



    // Deletes Raffle
    public function deleteRaffle(Request $request) {
        /* Find raffle in the database then delete */
        $raffle_id = $request->input('raffle_id');

        $raffle = Raffle::find($raffle_id);

        $raffle->delete();

        // Return the deleted raffle
        return response()->json($raffle);
    }
}
