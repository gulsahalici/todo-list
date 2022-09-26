<?php

namespace App\Http\Controllers\Api\User;

use App\Business\UserManager;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, UserManager $userManager)
    {
        return $userManager->getList();
    }
}
