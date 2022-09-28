<?php

namespace App\Http\Controllers\Api\Task;

use App\Business\TaskManager;
use App\Http\Controllers\Controller;
use App\Http\Requests\Task\IndexRequest as TaskIndexRequest;
use App\Http\Resources\TaskResource;
use App\Traits\HasPagination;

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
        
        return response()->json([ 
            'tasks' => TaskResource::collection($tasks),
            'pagination' => $this->paginate($tasks)
        ]);
    }
}
