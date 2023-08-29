<?php

namespace App\Http\Controllers;

use App\Models\TradingAccount;
use App\Models\Transaction;
use App\Models\Update;
use Illuminate\Http\Request;
use Validator;

class TradingAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(auth()->user()->userType != 'member'){
            $accounts = TradingAccount::all();
            return $this->sendResponse($accounts,'Successfully retruieve all trading accounts');
        }
        else{
            return $this->sendError('Unable to retrieve all trading accounts', 'No trading accounts were retrieved');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'userId' => ['required', 'exists:users,user_id']
        ]);

        if($validator->fails()){
            return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
        }
        $request['accountNo'] = $this->generateAccountNo();
        $tradingAccount = TradingAccount::create($request->only(['userId', 'accountNo']));
        if(!$tradingAccount){
            return $this->sendError('Unable To Create Trading Account', 'Please Contact Customer Service For Futher Actions');
        }
        else{
            return $this->sendResponse($tradingAccount, 'Trading Account Successfully Added');
        }

        
    }

    /**
     * Display the specified resource.
     * @param string $id ID of the account user
     */
    public function show(string $id)
    {
        //
        $tradingAccount = TradingAccount::where('userId', '=', $id)->firstorFail();
        if($tradingAccount){
            return $this->sendResponse($tradingAccount, 'Trading Account details is retreive successfully');
        }
        else{
            return $this->sendError('Unable to retrieve trading account', 'No trading account were retrieved');
        }
    }

    /**
     * Update status of the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $tradingAccount = TradingAccount::findorFail($id);
        if($tradingAccount){
            $validator = Validator::make($request->all(),[
                'status' => ['required'],
            ]);
    
            if($validator->fails()){
                return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
            }
            
        }
        else{
            return $this->sendError('Unable to retrieve trading account', 'No trading account were retrieved');
        }
        $oldStatus = $tradingAccount['status'];
        $tradingAccount['status'] = $request->status;
        $tradingAccount->save();

        $updateInfo = [
            'tradingAccountId' => $tradingAccount['tradingAccount_id'],
            'userId' => $tradingAccount['userId'],
            'statusBefore' => $oldStatus,
            'updatedBy' => auth()->user()->userId
        ];

        if($oldStatus == 'deny'){
            $updateInfo['rejectId'] = $tradingAccount['reject_id'];
        }
        $update = Update::create($updateInfo);
        if($update && $tradingAccount){
            return $this->sendResponse([
                'tradingAccount' => $tradingAccount,
                'update' => $update
            ], 'Trading status is successfully updated');
        }
        else{
            return $this->sendError('Unable to updates your trading account');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $deleteAccount = TradingAccount::findorFail($id);

        if($deleteAccount['initialBalance'] == 0 && $deleteAccount['balance'] == 0){
            $deleteAccount->delete();
            return $this->sendResponse($deleteAccount, 'Trading account deleted successfully');
        }
        else{
            return $this->sendError('Trading account is delete unsuccessful', 'Still have balance remain in the trading account');
        }
    }

    /**
     * Display the specified resource with transactions.
     */
    public function showWithTransactions(string $id)
    {
        //
        $tradingAccount = TradingAccount::with('transactions')->where('tradingAccount_id', $id)->get();
        if(!$tradingAccount){
            return $this->sendError('Unable to retrieve trading account', 'No trading account were retrieved');
        }

        else{
            return $this->sendResponse($tradingAccount, 'trading account with transactions information is retreieved');
        }
    }

    public function generateAccountNo(){
        do {
            $code = random_int(100000000000, 999999999999);
        } while (TradingAccount::where("accountNo", "=", str($code))->first());
  
        return str($code);
    }
}
