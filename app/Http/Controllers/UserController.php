<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Update;
use App\Models\User;
use Auth;
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
            $accounts = Account::with('user')->select('accounts.*', 'users.*')->get();
        }

        if(!empty($accounts)){
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
        $account = Account::with('user')->where('accounts.userId', $id)->select('accounts.*', 'users.*')->get();

        if(!empty($account)){
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

        if(!empty($updateUser)){
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

        if(!empty($restoreUser)){
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

        if(!empty($user)){
            $oldStatus = $user->status;
            $user['isVerified'] = true;
            $user['userType'] = 'member';
            if($request->isVerified){
                $user['status'] = 'verified';
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
