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
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//check if the user has login and access to the routers
Route::get('/checkUser', function (Request $request) {
    $result = [
        'result' => Auth::check(),
        'message' => 'Hi there'
    ];
    return response()->json($result);
});

Route::middleware('auth:api')->group(function (){
    //Bank API
    Route::apiResource('/bankAccount/account', BankAccountController::class);
    Route::get('/bankAccount/accountByUser/{id}', [BankAccountController::class, 'showByUserId']);

    //Trading Account API
    Route::apiResource('/tradingAccount/account', TradingAccountController::class);
    Route::get('/tradingAccount/accountDetails/{id}', [TradingAccountController::class, 'showWithTransactions']);
    Route::post('/tradingAccount/dividen', [TradingAccountController::class, 'distributeDividen']);

    //Transaction API
    Route::apiResource('/tradingAccount/transaction', TransactionController::class);
    Route::post('/tradingAccount/transaction/deposit', [TransactionController::class, 'completeDeposit']);
    Route::post('/tradingAccount/transaction/withdrawal', [TransactionController::class, 'completeWithdrawal']);

    //User API
    Route::apiResource('/user', UserController::class);
    Route::delete('/user/permentDelete/{id}', [UserController::class, 'destroyPermently']);
    Route::get('/user/restore/{id}', [UserController::class,'restore']);
    Route::post('/user/verify/{id}', [UserController::class,'verify']);

    //Reject Code API
    Route::get('/rejectReason/rejectType', [RejectReasonController::class, 'rejectType']);
    Route::apiResource('/rejectReason', RejectReasonController::class);

    //Updates API
    Route::get('/updates/{id}', [UpdateController::class, 'updates']);
    Route::get('/notification/{id}', [UpdateController::class, 'notification']);
});