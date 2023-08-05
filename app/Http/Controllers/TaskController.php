<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    public function __construct(
        protected Task $repository
    ) {
    }

    public function index()
    {
        $tasks = $this->repository->paginate();
        return TaskResource::collection($tasks);
    }

    public function store(TaskRequest $request)
    {
        $task = $this->repository->create($request->validated());
        return new TaskResource($task);
    }

    public function show(string $id)
    {
        $task = $this->repository->findOrFail($id);
        return new TaskResource($task);
    }

    public function update(TaskRequest $request, string $id)
    {
        $task = $this->repository->findOrFail($id);
        $task->update($request->validated());
        return new TaskResource($task);
    }

    public function destroy(string $id)
    {
        $task = $this->repository->findOrFail($id);
        $task->delete();
        return response()->json(
            ['message' => 'Department deleted successfully!'],
            Response::HTTP_OK,
        );
    }
}
