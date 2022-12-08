<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Business\UserManager;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, UserManager $userManager)
    {
        $user = $request->user();
        $userList = $userManager->getList();
        
        return Inertia::render('dashboard/Index', [
            'user' => $user,
            'userList' => $userList
        ]);
    }
}
