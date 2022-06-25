<?php

namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskService
{
    public function index()
    {
        return Task::query()->orderBy('id', 'desc')->get();
    }

    public function show($id)
    {
        return Task::find($id);
    }

    public function store(string $data): void
    {
        DB::transaction(function () use ($data) {
           $task = new Task();
           $task->name = $data;
           $task->save();
        });
    }

    public function update(int $id, $data): void
    {
        $task = Task::find($id);
        $task->name = $data['name'];
        $task->status = isset($data['status']) && $data['status'] == 'on';

        DB::transaction(function () use ($task) {
            $task->update();
        });
    }

    public function delete(int $id): void
    {
        DB::transaction(function () use ($id) {
           $task = Task::find($id);
           $task->delete();
        });
    }

}
