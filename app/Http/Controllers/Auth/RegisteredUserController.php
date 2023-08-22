<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validator = $request->validate([  
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.Account::class],
            'password' => 'required|min:8'|Rules\Password::defaults(),
            'password_confirmation' => 'required|min:8|same:password',
        ]);
        
        
        
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['userId'] = 1;
        $success = Account::create($input);
        if(!$success){
            return $this->sendError('Invalid Registeration');
        }
        
        if (auth('web')->attempt($success)) {
            $user = auth('web')->user();
            $success['username'] = $success['email'];
            $token = $user->createToken('Laravel Personal Access Client')->accessToken;
            return $this->sendResponse([
                'token' => $token,
                'user' => $user,
            ]);
        } else {
            return $this->sendError('Invalid Registeration');
        }
    }
}
