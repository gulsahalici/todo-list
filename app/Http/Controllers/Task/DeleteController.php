<?php

namespace App\Http\Controllers\Task;

use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Business\TaskManager;
use App\Models\Task;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Task $task, TaskManager $taskManager)
    {
        $taskManager->delete($task);

        return Redirect::back();
    }
}
