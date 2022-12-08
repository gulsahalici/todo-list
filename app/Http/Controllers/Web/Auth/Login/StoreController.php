<?php

namespace App\Http\Controllers\Web\Auth\Login;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Inertia\Inertia;
use App\Business\AuthManager;
use Illuminate\Support\Facades\Redirect;


class StoreController extends Controller
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
            return Inertia::render('auth/Login');
        }

        return Redirect::route('login.store')->with('token', $user->createToken("API TOKEN")->plainTextToken);
    }
}
