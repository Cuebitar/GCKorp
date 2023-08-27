<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Validator;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->userType == 'member'){
            $accounts = BankAccount::where('user_id', '=', Auth::user()->id)->all();
        }
        else{
            $accounts = BankAccount::all();
        }

        if($accounts){
            return $this->sendResponse($accounts,'Successfully retruieve all bank accounts');
        }
        else{
            return $this->sendError('Unable to retrieve bank accounts', 'No bank accounts were retrieved');
        }
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'bankName' => ['required'],
            'accountName' => ['required'],
            'accountNo' => ['required'],
            'bankStatement' => ['required'],
            'status' => ['required'],
            'isPrimary' => ['required', 'boolean'],
            'userId' => ['required', 'numeric', 'exists:users,user_id'],
        ]);

        if($validator->fails()){
            return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
        }

        if($request['userId'] != auth()->user()->userId){
            return $this->sendError('Invalid authorisation', 'invalid details');
        }

        $bankAccount = BankAccount::create($request->all());
        if(!$bankAccount){
            return $this->sendError('Unable To Create Bank Account', 'Please Contact Customer Service For Futher Actions');
        }
        else{
            return $this->sendResponse($bankAccount, 'Bank Account Successfully Added');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $accounts = BankAccount::findorFail($id);

        if($accounts){
            return $this->sendResponse($accounts,'Successfully retruieve all bank accounts');
        }
        else{
            return $this->sendError('Unable to retrieve bank accounts', 'No bank accounts were retrieved');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
        if(!array_diff_key(array_flip(['bankName', 'accountName', 'accountNo', 'isPrimary']), $request->all())){
            return $this->sendError('Unable to update these fields');
        }

        $updateBankAccount = BankAccount::findorFail($id);
        $updateBankAccount['bankStatement'] = $request->bankStatement;
        $updateBankAccount['status'] = $request->status;
        $updateBankAccount->save();

        if($updateBankAccount){
            return $this->sendResponse($updateBankAccount, 'The bank account has been updated successfully');
        }
        else{
            return $this->sendError('Bank Account is not updated', 'The bank statement is not updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       $deletedAccount = BankAccount::findorFail($id)->delete(); //

       if($deletedAccount){
        return $this->sendResponse($deletedAccount,'Successfully delete the bank accounts');
        }
        else{
            return $this->sendError('Unable to delete bank accounts', 'No bank accounts were deleted');
        }
    }
}
