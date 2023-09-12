<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Update;
use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;
use Validator;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        //
        $user = User::find(auth()->id());
        if($user->userType == 'member'){
            return $this->sendError('You are not allowed to reach this resources.');
        }
        else{
            $accounts = Account::with('user')->get();
        }

        if($accounts->isNotEmpty()){
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
        //
        $account = Account::with('user')->where('accounts.userId', $id)->get();

        if($account->isNotEmpty()){
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
        if(array_diff_key(array_flip($availableKeys), $request->all())){
            return $this->sendError('Unable to update these fields');
        }

        $validator = Validator::make($request->all(),[
            'phoneNumber' => ['string'],
            'email' => ['string', 'email', 'max:255', 'unique:accounts,email'],
            'password' => 'min:8',
            'password_confirmation' => 'min:8|same:password',
        ]);
        
        if($validator->fails()){
            return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
        }
        
        $updateUser = User::findorFail($id);
        $updateAccount = Account::findorFail($id);
        $request['password'] = Hash::make($request['password']);
        $updateAccount['password'] = $request['password'];
        $updateAccount['email'] = $request['email'];
        foreach($availableKeys as $key){
            if(isset($request[$key]) && $key != 'password_confirmation' && $key != 'password'){
                $updateUser[$key] = $request[$key];
            }
        }
        $updateAccount->save();
        $updateUser->save();

        if($updateUser && $updateAccount){
            return $this->sendResponse([
                'updatedUser' => $updateUser,
                'updatedAccount' => $updateAccount
            ], 'The user account has been updated successfully');
        }
        else{
            return $this->sendError('User Account is not updated', 'The user account is not updated successfully');
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

     /**
     * Remove the specified resource from storage.
     * Soft deletes account
     */
    public function destroyPermently(string $id)
    {
        //
        $deleteUser = User::find($id)->delete();
        $deleteAccount = Account::findorFail($id);
        $deleteAccount->forceDelete();
        
        if($deleteAccount){
            return $this->sendResponse($deleteUser,'Successfully delete the user');
        }
        else{
            return $this->sendError('Unable to delete the user', 'No user were deleted');
        }
    }

    public function restore(string $id){
        $restoreUser = Account::where('account_id', $id)->withTrashed()->restore();

        if($restoreUser->isNotEmpty()){
            return $this->sendResponse($restoreUser,'Successfully restore the user');
            }
            else{
                return $this->sendError('Unable to restore the user', 'No user were restore');
            }
    }

    public function verify(Request $request, string $id){
        
        $validator = Validator::make($request->all(),[
            'isVerified' => ['required', 'boolean'],
        ]);

        if($validator->fails()){
            return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
        }

        $user = User::findorFail($id);
        if($user['isVerified'] == true){
            return $this->sendError('this user has already verified');
        }

        if($user){
            $oldStatus = $user->status;
            $user['isVerified'] = $request['isVerified'];
            
            if($request->isVerified){
                $user['userType'] = 'member';
                $user['status'] = 'active';
            }
            else{
                $validator = Validator::make($request->all(),[
                    'rejectId' => ['required', 'boolean'],
                ]);
        
                if($validator->fails()){
                    return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
                }

                $user['status'] = 'deny';
                $user['rejectId'] = $request->rejectId;
            }
            $user->save();
            $updateInfo = [
                'userId' => $id,
                'statusBefore' => $oldStatus,
                'updatedBy' => auth()->id()
            ];
            if($oldStatus == 'deny'){
                $updateInfo['rejectId'] = $user['reject_id'];
            }
            $update = Update::create($updateInfo);

            if(empty($update)){
                return $this->sendError('Unable to Create Update', 'Please contact admin for futhur assistance');
            }

            return $this->sendResponse($user, 'User is verified');
        }
        else{
            return $this->sendError('Unable to retreive user', 'Please contact admin for futhur assistance');
        }
    }
}