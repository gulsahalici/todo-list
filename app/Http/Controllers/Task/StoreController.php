<?php

namespace App\Http\Controllers\Task;

use App\Business\TaskManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest as TaskStoreRequest;
use App\Http\Resources\TaskResource;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(TaskStoreRequest $request, TaskManager $taskManager)
    {
        $task = $taskManager->create($request->validated());

        return response()->json([         
            'message' => 'Task created.',
            'task' => new TaskResource($task)
        ]);
    }
}
