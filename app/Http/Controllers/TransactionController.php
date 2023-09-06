<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TradingAccount;
use App\Models\Transaction;
use App\Models\Update;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Validator;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        return $this->sendError('please specific trading account');
    }



    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(),[
            'tradingAccountId' => ['required', 'exists:trading_accounts,tradingAccount_id', 'numeric'],
            'bankAccountId' => ['exists:bank_accounts,bankAccount_id', 'numeric'],
            'amount' => ['required', 'numeric'],
            'status' => ['required'],
            'type' => ['required', 'in:deposit,withdrawal,dividen'],
            'transactionPurpose' => ['required'],
        ]);

        if($validator->fails()){
            return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
        }

        $request['referenceId'] = $this->generateReferenceID();
        $transactionInfo = $request->only('tradingAccountId', 'bankAccountId', 'amount', 'status', 'type', 'transactionPurpose', 'referenceId');

        $transaction = Transaction::create($transactionInfo);
        if(!empty($transaction)){
            return $this->sendResponse($transaction, 'Transaction successful created');
        }
        else{
            return $this->sendError('Transaction failed to create');
        }
    }

     /**
    * Insert money into the trading account
    * @param Request $request amount to be added to the account
    */
    public function completeDeposit(Request $request){
         
            $validator = Validator::make($request->all(),[
                'transaction_id' => ['required', 'exists:transactions,transaction_id'],
                'tradingAccount_id' => ['required', 'exists:trading_accounts,tradingAccount_id'],
                'approve' => ['required', 'boolean'],
                'type' => ['required', 'in:deposit,dividen'],
            ]);
    
            if($validator->fails()){
                return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
            }
        
        $tradingAccount = TradingAccount::findorFail($request->tradingAccount_id);
        $masterAccount = TradingAccount::findorFail(1);
        $transaction = Transaction::findorFail($request->transaction_id);
        if(!$tradingAccount || !$masterAccount || !$transaction || $transaction['type'] != 'deposit' && $transaction['type'] != 'dividen'){
            return $this->sendError('Unable to retrieve transaction', 'No transaction were retrieved');
        }
        
        if($transaction['status'] == 'completed' || $transaction['status'] == 'deny'){
            return $this->sendError('This transaction is completed', 'Duplication of the completion of the transaction');
        }
        //transaction approve or reject
        $oldStatus = $tradingAccount['status'];
        $request['amount'] = $transaction['amount'];
        if($request->approve){
            if($request->type == 'deposit' && $request->tradingAccount_id == 1){   
                $tradingAccount['balance'] += $request->amount;
            }
            else if($request->type == 'deposit'){
                $tradingAccount['balance'] += $request->amount;
                $tradingAccount['initialBalance'] += $request->amount;
                $masterAccount['balance'] += $request->amount;
                $masterAccount['initialBalance'] += $request->amount;
                $masterAccount->save();
            }
            else if($request->type == 'dividen'){
                $tradingAccount['balance'] += $request->amount;
                $tradingAccount['initialBalance'] += $request->amount;
                $masterAccount['balance'] -= $request->amount;
                if($masterAccount['balance'] < $masterAccount['initialBalance']){
                    $masterAccount['initialBalance'] = $masterAccount['balance'];
                }
                $masterAccount->save();
            }
            $tradingAccount->save();
            

            $transaction['status'] = 'completed';
        }
        else{
            $validator = Validator::make($request->all(),[
                'rejectId' => ['required', 'exists:reject_reasons,reject_id'],
            ]);
    
            if($validator->fails()){
                return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
            }

            $transaction['status'] = 'deny';
            $transaction['rejectId'] = $request->rejectId;

            /**$newTransactionInfo = [
                'tradingAccountId' => $request->tradingAccount_id,
                'bankAccountId' => $transaction['bankAccountId'],
                'amount' => $request->amount,
                'status' => 'pending',
                'type' => 'refund',
                'transactionPurpose' => 'Fund deposit unsuccessful',
                'referenceId' => $this->generateReferenceID(),
            ];
            $newTransaction = Transaction::create($newTransactionInfo);*/
        }
        $transaction['completedAt'] = Carbon::now();
        $transaction['completedBy'] = auth()->id();
        $transaction->save();

        $updateInfo = [
            'transactionId' => $request->transaction_id,
            'bankAccountId' => $transaction['bankAccountId'],
            'tradingAccountId' => $transaction['tradingAccountId'],
            'userId' => $tradingAccount['userId'],
            'statusBefore' => $oldStatus,
            'updatedBy' => auth()->user()->userId
        ];
        if($oldStatus == 'deny'){
            $updateInfo['rejectId'] = $transaction['reject_id'];
        }
        $update = Update::create($updateInfo);
        
        if(!empty($update) && !empty($transaction) && !empty($tradingAccount) && $transaction['status'] == 'deny'){
            return $this->sendResponse([
                'tradingAccount' => $tradingAccount,
                'transaction' => $transaction,
                'update' => $update
            ], 'Money refund to user');
        }
        else if(!empty($update) && !empty($transaction) && !empty($tradingAccount)){
            return $this->sendResponse([
                'tradingAccount' => $tradingAccount,
                'transaction' => $transaction,
                'update' => $update
            ], 'Money is successfully insert into trading account');
        }
        else{
            return $this->sendError('Some error occurred', 'Please contact admin for futhur assistance');
        }
    }

     /**
    * Insert money into the trading account
    * @param Request $request amount to be added to the account
    */
    public function completeWithdrawal(Request $request){
         
            $validator = Validator::make($request->all(),[
                'transaction_id' => ['required', 'exists:transactions,transaction_id'],
                'tradingAccount_id' => ['required', 'exists:trading_accounts,tradingAccount_id'],
                'approve' => ['required', 'boolean'],
                'type' => ['required', 'in:withdrawal'],
            ]);
    
            if($validator->fails()){
                return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
            }
            else if($request->type != 'withdrawal'){
                return $this->sendError('Withdrawal request only');
            }
        
        $tradingAccount = TradingAccount::findorFail($request->tradingAccount_id);
        $masterAccount = TradingAccount::findorFail(1);
        $transaction = Transaction::findorFail($request->transaction_id);

        if($request->transaction_id == 1 || !$masterAccount || !$tradingAccount || !$transaction || $transaction['type'] != 'withdrawal'){
            return $this->sendError('Unable to retrieve trading account', 'No trading account were retrieved');
        }
        
        if($transaction['status'] == 'completed' || $transaction['status'] == 'deny'){
            return $this->sendError('This transaction is completed', 'Duplication of the completion of the transaction');
        }

        //transaction approve or reject
        $oldStatus = $tradingAccount['status'];
        if($request->approve){
            $request['amount'] = $transaction['amount'];
            if($request->amount > $tradingAccount['balance']){    
                return $this->sendError('Unable to withdrawal', 'Insufficient funds');
            }
            $tradingAccount['balance'] -= $request->amount;
            if($tradingAccount['balance'] < $tradingAccount['initialBalance']){
                $withdrawInitialBalance = $tradingAccount['initialBalance'] - $tradingAccount['balance'];
                $tradingAccount['initialBalance'] = $tradingAccount['balance'];
                $masterAccount['initialBalance'] -= $withdrawInitialBalance;
                $masterAccount['balance'] -= $withdrawInitialBalance; 
                $masterAccount->save();
            }
            $tradingAccount->save();

            $transaction['status'] = 'completed';
        }
        else{
            $validator = Validator::make($request->all(),[
                'rejectId' => ['required', 'exists:reject_reasons,reject_id'],
            ]);
    
            if($validator->fails()){
                return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
            }

            $transaction['status'] = 'deny';
            $transaction['rejectId'] = $request->rejectId;
        }
        $transaction['completedAt'] = Carbon::now();
        $transaction['completedBy'] = auth()->user()->userId;
        $transaction->save();

        $updateInfo = [
            'transactionId' => $request->transaction_id,
            'bankAccountId' => $transaction['bankAccountId'],
            'tradingAccountId' => $transaction['tradingAccountId'],
            'userId' => $tradingAccount['userId'],
            'statusBefore' => $oldStatus,
            'updatedBy' => auth()->user()->userId
        ];
        if($oldStatus == 'deny'){
            $updateInfo['rejectId'] = $transaction['reject_id'];
        }
        $update = Update::create($updateInfo);
        if(!empty($update) && !empty($transaction) && !empty($tradingAccount) && $transaction['status'] == 'completed'){
            return $this->sendResponse([
                'tradingAccount' => $tradingAccount,
                'transaction' => $transaction,
                'update' => $update
            ], 'Money is successfully withdrawal from trading account');
        }
        else if(!empty($update) && !empty($transaction) && !empty($tradingAccount) && $transaction['status'] == 'deny'){
            return $this->sendResponse([
                'tradingAccount' => $tradingAccount,
                'transaction' => $transaction,
                'update' => $update
            ], 'Money is not successfully withdrawal from trading account');
        }
        else{
            return $this->sendError('Some error occurred', 'Please contact admin for futhur assistance');
        }
    }

    /**
     * Display the specified resource.
     * @param string $id Trading account ID
     */
    public function show(string $id)
    {
        $transactions = Transaction::where('tradingAccountId', $id)->get();
        if(!empty($transactions)){
            return $this->sendResponse($transactions, 'transactions retreieved');
        }
        else{
            return $this->sendError('Unable to retrieve transactions');
        }
    }

    public function generateReferenceID(){
        do {
            $code = Str::random(3);
            $code .= str(random_int(1000, 9999));
        } while (Transaction::where("referenceId", "=", $code)->first());
  
        return str($code);
    }
}
