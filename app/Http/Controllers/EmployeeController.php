<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    public function __construct(
        protected Employee $repository
    ) {
    }

    public function index()
    {
        $employees = $this->repository->paginate();
        return EmployeeResource::collection($employees);
    }

    public function store(EmployeeRequest $request)
    {
        $employee = $this->repository->create($request->validated());
        return new EmployeeResource($employee);
    }

    public function show(string $id)
    {
        $employee = $this->repository->findOrFail($id);
        return new EmployeeResource($employee);
    }

    public function update(EmployeeRequest $request, string $id)
    {
        $employee = $this->repository->findOrFail($id);
        $employee->update($request->validated());
        return new EmployeeResource($employee);
    }

    public function destroy(string $id)
    {
        $employee = $this->repository->findOrFail($id);
        $employee->delete();
        return response()->json(
            ['message' => 'Department deleted successfully!'],
            Response::HTTP_OK,
        );
    }
}
