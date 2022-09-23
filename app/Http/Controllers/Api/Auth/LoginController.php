<?php

namespace App\Http\Controllers\Api\Auth;

use App\Business\AuthManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;

class LoginController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(LoginRequest $request, AuthManager $authManager)
    {
        
        $user = $authManager->login($request->validated());

        if(!$user) {
            return response()->json([         
                'message' => 'Email or password incorrect.'
            ]);
        }

        return response()->json([         
            'message' => 'User logged in.',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ]);
    }
}
