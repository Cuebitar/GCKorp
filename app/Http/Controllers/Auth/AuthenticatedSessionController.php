<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Laravel\Passport\PersonalAccessTokenFactory;
use Illuminate\Validation\ValidationException;
use Laravel\Passport\Passport;
use App\Models\Account;
class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        
        if (auth('web')->attempt($credentials)) {
            $user = auth('web')->user();
            $credentials['username'] = $credentials['email'];
            $token = $user->createToken('Laravel Personal Access Client')->accessToken;
            return $this->sendResponse([
                'token' => $token,
                'user' => $user,
            ]);
        } else {
            return $this->sendError('Invalid Login');
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
         // Get the authenticated user
         $user = $request->user();

         // Revoke all of the user's tokens
         $user->tokens()->delete();
 
        return $this->sendResponse([
            'message' => 'All tokens revoked successfully',
        ]);
    }
}
