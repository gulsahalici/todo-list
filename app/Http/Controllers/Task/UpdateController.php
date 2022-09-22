<?php

namespace App\Http\Controllers\Task;

use App\Business\TaskManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateRequest as TaskUpdateRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(TaskUpdateRequest $request, Task $task, TaskManager $taskManager)
    {
        $task = $taskManager->update($task, $request->validated());

        return response()->json([         
            'message' => __('Task updated.'),
            'task' => new TaskResource($task)
        ]);
    }
}
