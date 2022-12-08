<?php

namespace App\Http\Controllers\Web\Auth\Register;

use App\Business\AuthManager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\Auth\RegisterRequest;

class StoreController extends Controller
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

        if(!$user) {
            return Inertia::render('auth/Register');
        }

        return Redirect::route('register.store')->with('token', $user->createToken("API TOKEN")->plainTextToken);
    }
}
