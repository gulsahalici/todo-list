<?php

namespace App\Http\Controllers\Api\Auth;

use App\Business\AuthManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request, AuthManager $authManager)
    {
        $user = $authManager->register($request->validated());
        
        $user = $authManager->login($request->validated());
        
        return response()->json([         
            'message' => 'User registered.',
            'token' => $user->createToken("API TOKEN")->plainTextToken
        ], 200);
    }
}
