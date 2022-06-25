<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TaskController extends Controller
{
    protected $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tasks = $this->taskService->index();

        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $name = $request->get('name');

        $this->taskService->store($name);

        return response()->json('Tarefa cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function show(int $id): JsonResponse
    {
        return response()->json($this->taskService->show($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $data = $request->all();
        $this->taskService->update($id, $data);

        return response()->json('Tarefa alterada com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return JsonResponse
     */
    public function delete(Request $request): JsonResponse
    {
        $this->taskService->delete($request->get('id'));

        return response()->json('Tarefa deletada com sucesso!');

    }
}
