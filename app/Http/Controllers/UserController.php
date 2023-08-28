<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Update;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        if(auth()->user()->userType == 'member'){
            return $this->sendError('You are not allowed to reach this resources.');
        }
        else{
            $accounts = Account::with('user')->get();
        }

        if($accounts){
            return $this->sendResponse($accounts,'Successfully retruieve all user details');
        }
        else{
            return $this->sendError('Unable to retrieve user details', 'No user\'s details were retrieved');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $account = Account::with('user')->where('accounts.userId', $id)->get();

        if($account){
            return $this->sendResponse($account,'Successfully retruieve user details');
        }
        else{
            return $this->sendError('Unable to retrieve user details', 'No user\'s details were retrieved');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $availableKeys = ['address', 'phoneNumber', 'email', 'password', 'password_confirmation'];
        if(!array_diff_key(array_flip($availableKeys), $request->all())){
            return $this->sendError('Unable to update these fields');
        }

        $validator = Validator::make($request->all(),[
            'phoneNumber' => ['required'],
            'email' => ['string', 'email', 'max:255', 'unique:'.Account::class],
            'password' => 'min:8',
            'password_confirmation' => 'min:8|same:password',
        ]);
        
        if($validator->fails()){
            return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
        }
        
        $updateUser = User::findorFail($id);
        foreach($availableKeys as $key){
            if(isset($request[$key]) && $key != 'password_confirmation'){
                $updateUser[$key] = $request[$key];
            }
        }
        $updateUser->save();

        if($updateUser){
            return $this->sendResponse($updateUser, 'The bank account has been updated successfully');
        }
        else{
            return $this->sendError('Bank Account is not updated', 'The bank statement is not updated successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     * Soft deletes account
     */
    public function destroy(string $id)
    {
        //
        $deleteUser = Account::findorFail($id)->delete();

        if($deleteUser){
            return $this->sendResponse($deleteUser,'Successfully delete the user');
            }
            else{
                return $this->sendError('Unable to delete the user', 'No user were deleted');
            }
    }

    public function restore(string $id){
        $restoreUser = Account::where('account_id', $id)->withTrashed()->restore();

        if($restoreUser){
            return $this->sendResponse($restoreUser,'Successfully restore the user');
            }
            else{
                return $this->sendError('Unable to restore the user', 'No user were restore');
            }
    }

    public function verify(string $id){
        $user = User::findorFail($id);

        if($user){
            $oldStatus = $user->status;
            $user['isVerified'] = true;
            $user['status'] = 'verified';
            $user->save();
            $updateInfo = [
                'userId' => $id,
                'statusBefore' => $oldStatus,
                'updatedBy' => auth()->user()->userId
            ];
            $update = Update::create($updateInfo);

            if(!$update){
                return $this->sendError('Unable to Create Update', 'Please contact admin for futhur assistance');
            }

            return $this->sendResponse($user, 'User is verified');
        }
        else{
            return $this->sendError('Unable to retreive user', 'Please contact admin for futhur assistance');
        }
    }
}
