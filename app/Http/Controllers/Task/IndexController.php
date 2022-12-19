<?php

namespace App\Http\Controllers\Task;

use App\Http\Requests\Task\IndexRequest as TaskIndexRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\TaskResource;
use App\Traits\HasPagination;
use App\Business\UserManager;
use App\Business\TaskManager;
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
    public function __invoke(TaskIndexRequest $request, UserManager $userManager, TaskManager $taskManager)
    {
        $user = $request->user();
        $userList = $userManager->getList();
        $tasks = $taskManager->getList($request['filter'] ?? []);
        
        return Inertia::render('task/Index', [
            'user' => $user,
            'userList' => $userList,
            'tasks' => TaskResource::collection($tasks),
            'pagination' => $this->paginate($tasks)
        ]);
    }
}
