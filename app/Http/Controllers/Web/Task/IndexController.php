<?php

namespace App\Http\Controllers\Web\Task;

use App\Http\Controllers\Controller;
use App\Business\TaskManager;
use App\Http\Requests\Task\IndexRequest as TaskIndexRequest;
use App\Http\Resources\TaskResource;
use App\Traits\HasPagination;
use Inertia\Inertia;

class IndexController extends Controller
{
    use HasPagination;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(TaskIndexRequest $request, TaskManager $taskManager)
    {
        $tasks = $taskManager->getList($request->validated());
        
        return Inertia::render('dashboard/Index', [
            'tasks' => TaskResource::collection($tasks),
            'pagination' => $this->paginate($tasks)
        ]);
    }
}
