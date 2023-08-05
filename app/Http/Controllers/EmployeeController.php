<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Requests\EmployeeRequest;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Response;

/**
 * @OA\Tag(
 *     name="Employees",
 *     description="Endpoints for managing employees"
 * )
 */

class EmployeeController extends Controller
{
    public function __construct(
        protected Employee $repository
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/employees",
     *     summary="Returns a list of employees",
     *     @OA\Response(
     *         response=200,
     *         description="List of employees",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Employee")),
     *             @OA\Property(property="meta", ref="#/components/schemas/PaginationMeta"),
     *             @OA\Property(property="links", ref="#/components/schemas/PaginationLinks")
     *         )
     *     ),
     *     security={ {"bearerAuth": {}} },
     *     tags={"Employees"}
     * )
     */
    public function index()
    {
        $employees = $this->repository::orderBy('created_at', 'asc')->paginate();
        return EmployeeResource::collection($employees);
    }

    /**
     * @OA\Post(
     *     path="/api/employees",
     *     summary="Create a new employee",
     *     @OA\RequestBody(
     *         description="Employee object that needs to be added",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="firstName", type="string", example="John", description="First name of the employee"),
     *             @OA\Property(property="lastName", type="string", example="Doe", description="Last name of the employee"),
     *             @OA\Property(property="email", type="string", example="john.doe@example.com", description="Email address of the employee"),
     *             @OA\Property(property="phone", type="string", example="123-456-7890", description="Phone number of the employee"),
     *             @OA\Property(property="department_id", type="integer", example=1, description="ID of the department to which the employee belongs")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Employee created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Employee")),
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object", example={"firstName": {"The firstName field is required."}})
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(ref="#/components/schemas/InternalServerError")
     *     ),
     *     security={ {"bearerAuth": {}} },
     *     tags={"Employees"}
     * )
     */
    public function store(EmployeeRequest $request)
    {
        $employee = $this->repository->create($request->validated());
        return new EmployeeResource($employee);
    }

    /**
     * @OA\Get(
     *     path="/api/employees/{id}",
     *     summary="Get a employee by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the employee",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Employee details",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/Employee")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Employee not found",
     *         @OA\JsonContent(ref="#/components/schemas/NotFoundError")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(ref="#/components/schemas/InternalServerError")
     *     ),
     *     security={ {"bearerAuth": {}} },
     *     tags={"Employees"}
     * )
     */
    public function show(string $id)
    {
        $employee = $this->repository->findOrFail($id);
        return new EmployeeResource($employee);
    }

    /**
     * @OA\Put(
     *     path="/api/employees/{id}",
     *     summary="Update a employee by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the employee",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         description="Employee object that needs to be updated",
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="firstName", type="string", example="John", description="First name of the employee"),
     *             @OA\Property(property="lastName", type="string", example="Doe", description="Last name of the employee"),
     *             @OA\Property(property="email", type="string", example="john.doe@example.com", description="Email address of the employee"),
     *             @OA\Property(property="phone", type="string", example="123-456-7890", description="Phone number of the employee"),
     *             @OA\Property(property="department_id", type="integer", example=1, description="ID of the department to which the employee belongs")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Employee details",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/Employee")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Employee not found",
     *         @OA\JsonContent(ref="#/components/schemas/NotFoundError")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object", example={"firstName": {"The firstName field is required."}})
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(ref="#/components/schemas/InternalServerError")
     *     ),
     *     security={ {"bearerAuth": {}} },
     *     tags={"Employees"}
     * )
     */
    public function update(EmployeeRequest $request, string $id)
    {
        $employee = $this->repository->findOrFail($id);
        $employee->update($request->validated());
        return new EmployeeResource($employee);
    }

    /**
     * @OA\Delete(
     *     path="/api/employees/{id}",
     *     summary="Delete a employee by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the employee",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Employee deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Employee not found",
     *         @OA\JsonContent(ref="#/components/schemas/NotFoundError")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(ref="#/components/schemas/InternalServerError")
     *     ),
     *     security={ {"bearerAuth": {}} },
     *     tags={"Employees"}
     * )
     */
    public function destroy(string $id)
    {
        $employee = $this->repository->findOrFail($id);
        $employee->delete();
        return response()->json(
            [],
            Response::HTTP_NO_CONTENT,
        );
    }
}
