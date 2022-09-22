<?php 

namespace App\Business;

use App\Models\Task;

class TaskManager
{
    public function getList()
    {
        return Task::all();
    }

    public function create(array $data)
    {
        $task = Task::create($data);

        return $task;
    }

    public function update(Task $task, array $data) {
        $task->update($data);

        return $task;
    }   

    public function delete(Task $task) {
        return $task->delete();
    }

}