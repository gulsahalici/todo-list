<?php

namespace App\Http\Controllers\Web\Task;

use App\Business\TaskManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest as TaskStoreRequest;
use Illuminate\Support\Facades\Redirect;

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
        $taskManager->create($request->validated());

        return Redirect::route('task.store');
    }
}
