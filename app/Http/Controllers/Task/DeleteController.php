<?php

namespace App\Http\Controllers\Task;

use App\Business\TaskManager;
use App\Http\Controllers\Controller;
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
        if(!$taskManager->delete($task)) {
            return response()->json([         
                'message' => 'Failed to delete task.'
            ]);
        }
       
        return response()->json([         
            'message' => 'Task deleted.'
        ]);
    }
}
