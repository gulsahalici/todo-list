<?php

namespace App\Http\Controllers\Api\Task;

use App\Business\TaskManager;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Traits\HasPagination;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    use HasPagination;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, TaskManager $taskManager)
    {
        $tasks = $taskManager->getList();
        
        return response()->json([ 
            'tasks' => TaskResource::collection($tasks),
            'pagination' => $this->paginate($tasks)
        ]);
    }
}
