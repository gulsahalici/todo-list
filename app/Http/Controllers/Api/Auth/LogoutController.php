<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        auth()->user()->tokens()->delete();
        $request->session()->invalidate();


        return view('login');
        // return response()->json([         
        //     'message' => 'User logged out.'
        // ]);
    }
}
