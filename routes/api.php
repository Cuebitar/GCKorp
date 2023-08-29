<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisteredUserController ;
use App\Http\Controllers\BankAccountController;
use App\Http\Controllers\RejectReasonController;
use App\Http\Controllers\TradingAccountController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UpdateController;
use App\Http\Controllers\UserController;
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

//check if the user has login and access to the routers
Route::get('/checkser', function (Request $request) {
    return response()->json(Auth::check());
});

Route::middleware('auth:api')->group(function (){
    //Bank API
    Route::apiResource('/bankAccount/account', BankAccountController::class);

    //Trading Account API
    Route::apiResource('/tradingAccount/account', TradingAccountController::class);
    Route::get('/tradingAccount/accountDetails/{id}', [TradingAccountController::class, 'showWithTransactions']);

    //Transaction API
    Route::apiResource('/tradingAccount/transaction', TransactionController::class);
    Route::post('/tradingAccount/transaction/deposit', [TransactionController::class, 'completeDeposit']);
    Route::post('/tradingAccount/transaction/withdraw', [TransactionController::class, 'completeWithdrawal']);

    //User API
    Route::apiResource('/user', UserController::class);
    Route::post('/user/restore/{id}', [UserController::class,'restore']);
    Route::post('/user/verify/{id}', [UserController::class,'verify']);

    //Reject Code API
    Route::get('/rejectReason/rejectType', [RejectReasonController::class, 'rejectType']);
    Route::apiResource('/rejectReason', RejectReasonController::class);
});