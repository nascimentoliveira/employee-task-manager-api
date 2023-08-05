<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use Illuminate\Http\Response;

class DepartmentController extends Controller
{
    public function __construct(
        protected Department $repository
    ) {
    }

    public function index()
    {
        $departments = $this->repository->paginate();
        return DepartmentResource::collection($departments);
    }


    public function store(DepartmentRequest $request)
    {
        $department = $this->repository->create($request->validated());
        return new DepartmentResource($department);
    }


    public function show(string $id)
    {
        $department = $this->repository->findOrFail($id);
        return new DepartmentResource($department);
    }


    public function update(DepartmentRequest $request, string $id)
    {
        $department = $this->repository->findOrFail($id);
        $department->update($request->validated());
        return new DepartmentResource($department);
    }


    public function destroy(string $id)
    {
        $department = $this->repository->findOrFail($id);
        $department->delete();
        return response()->json(
            ['message' => 'Department deleted successfully!'],
            Response::HTTP_OK,
        );
    }
}
