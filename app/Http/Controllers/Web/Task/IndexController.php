<?php

namespace App\Http\Controllers\Web\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\IndexRequest as TaskIndexRequest;
use Inertia\Inertia;
use App\Business\UserManager;
use App\Business\TaskManager;
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
