<?php

namespace App\Http\Controllers\Api\Task;

use App\Business\TaskManager;
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
    public function __invoke(Request $request, TaskManager $taskManager)
    {
        return $taskManager->getList();
    }
}