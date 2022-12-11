<?php

namespace App\Http\Controllers\Web\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\UpdateRequest as TaskUpdateRequest;
use Illuminate\Support\Facades\Redirect;
use App\Business\TaskManager;
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
        $taskManager->update($task, $request->validated());

        return Redirect::back();
    }
}
