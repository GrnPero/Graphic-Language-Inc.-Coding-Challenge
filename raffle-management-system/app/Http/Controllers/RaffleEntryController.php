<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// RaffleEntry Model
use App\Models\RaffleEntry;

class RaffleEntryController extends Controller
{
    // User submits the raffle to the database
    public function submitRaffleEntry(Request $request) {
        // Grabs all the inputs from the form and makes it into an array
        $inputs = $request->all(); 

        // Create an array to grab the checkboxes
        $checkboxes = array();

        // Match all the checkboxes from the frontend and save their values in the $checkboxes array
        foreach ($inputs as $key => $value) {
            if (preg_match("/^checkbox_(\d)*/", $key)) {
                array_push($checkboxes, $value);    
            }
        }

        // Add all the data from the form to the database
        for ($i = 0; $i < count($checkboxes); $i++) {
            $raffle_entry = RaffleEntry::create([
                'full_name' => $request->input('full_name'),
                'phone_number' => $request->input('phone'),
                'raffle_id' => $checkboxes[$i],
                'raffle_entry_id' => uniqid()
            ]);
        }
        
        $raffle_entry->save();
        
        
        if ($i == count($checkboxes)) {
            return response()->json("Successfully submitted");
        }        

        return response()->json('Failed!', 400);
    }
}