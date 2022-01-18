<?php

use App\Http\Controllers\TransactionController;
use App\Models\AccountHolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('/transaction', [TransactionController::class, 'store']);

Route::get('/users', function (Request $request) {
    return AccountHolder::with('account')->get();
});
