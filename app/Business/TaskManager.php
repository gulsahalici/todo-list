<?php 

namespace App\Business;

use App\Models\Task;

class TaskManager
{
    public function getList(array $data)
    {
        $query = Task::with('user');

        if(isset($data['description'])) {
            $query->where('description', 'LIKE', "%{$data['description']}%");
        }

        if(isset($data['user_id'])) {
            $query->where('user_id', $data['user_id']);
        }

        if(isset($data['status'])) {
            $query->where('status', $data['status']);
        }

        return $query->orderBy('created_at', 'desc')->paginate(10);
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