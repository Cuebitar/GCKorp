<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Validator;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => ['required'],
            'IC' => ['required', 'unique:users,IC'],
            'ICDocument' => ['required'],
            'phoneNumber' => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Account::class],
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
            'gender' => ['in:male,female', 'required'],
            'religion' => ['required'],
            'race' => ['required'],
            'userType' => ['in:guest,member,super_admin,admin_staff,operation_staff,super_operation_staff,account_staff,admin', 'required'],
            'status' => ['required'],
            'address' => ['required'],
            'isVerified' => ['required', 'boolean'],
        ]);
        
        if($validator->fails()){
            return $this->sendError(['errors'=>$validator->messages()], 'invalid details');
        }
        
        $input = $request->all();
        unset($input["password"]);
        unset($input["password_confirmation"]);
        $userDetails = User::create($input);

        if($userDetails){
            $successUser['password'] = Hash::make($request['password']);
            $successUser['email'] = $request['email'];
            $successUser['userId'] = $userDetails->user_id;
            $success = Account::create($successUser);
            if(!$success){
                return $this->sendError('Invalid Registeration');
            }
            unset($successUser['userId']);
            $successUser['password'] = $request['password'];
            if (auth('web')->attempt($successUser)) {
                $user = auth('web')->user();
                $successUser['username'] = $successUser['email'];
                $token = $user->createToken('Laravel Personal Access Client')->accessToken;
                return $this->sendResponse([
                    'token' => $token,
                    'account' => $user,
                    'user' => $userDetails,
                ]);
            } else {
                return $this->sendError('Invalid Login');
            }
        }
        else{
            return $this->sendError(['Unable to Create User'], 'invalid details');
        }
        
    }
}
