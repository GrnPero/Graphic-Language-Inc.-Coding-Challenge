<?php

use Illuminate\Support\Facades\Route;

/* Controller */
use App\Http\Controllers\RaffleController;
use App\Http\Controllers\RaffleEntryController;
use App\Http\Controllers\WinnerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Home page is the raffle entry page
Route::get('/', [RaffleController::class, 'getAllRafflesHomePage']);

// Handles raffle submition 
Route::post('/submitRaffle', [RaffleEntryController::class, 'submitRaffleEntry']);

/* Raffle Creation CRUD Page */

// Raffle creation page
Route::get('/raffle-creation', [RaffleController::class, 'getAllRaffles']);

// Creates a new raffle for the contestant 
Route::post('/createRaffle', [RaffleController::class, 'submitRaffle']);

// Deletes the Raffle
Route::delete('/deleteRaffle', [RaffleController::class, 'deleteRaffle']);

/* Winner Routes */

// Grabs the winner page and contestants 
Route::get('/winner', [WinnerController::class, 'winnerSelection']);

// Chooses the winners
Route::post('/selecting-winners', [WinnerController::class, 'selectWinners']);

