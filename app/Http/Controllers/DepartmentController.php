<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use App\Http\Resources\DepartmentResource;
use Illuminate\Http\Response;

/**
 * @OA\Tag(
 *     name="Departments",
 *     description="Endpoints for managing departments"
 * )
 */

class DepartmentController extends Controller
{
    public function __construct(
        protected Department $repository
    ) {
    }

    /**
     * @OA\Get(
     *     path="/api/departments",
     *     summary="Returns a list of departments",
     *     @OA\Response(
     *         response=200,
     *         description="List of departments",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Department")),
     *             @OA\Property(property="meta", ref="#/components/schemas/PaginationMeta"),
     *             @OA\Property(property="links", ref="#/components/schemas/PaginationLinks")
     *         )
     *     ),
     *     security={ {"bearerAuth": {}} },
     *     tags={"Departments"}
     * )
     */
    public function index()
    {
        $departments = $this->repository::orderBy('created_at', 'asc')->paginate();
        return DepartmentResource::collection($departments);
    }

    /**
     * @OA\Post(
     *     path="/api/departments",
     *     summary="Create a new department",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Department object that needs to be added",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="HR Department")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Department created successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/Department")),
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object", example={"name": {"The name field is required."}})
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(ref="#/components/schemas/InternalServerError")
     *     ),
     *     security={ {"bearerAuth": {}} },
     *     tags={"Departments"}
     * )
     */
    public function store(DepartmentRequest $request)
    {
        $department = $this->repository->create($request->validated());
        return new DepartmentResource($department);
    }

    /**
     * @OA\Get(
     *     path="/api/departments/{id}",
     *     summary="Get a department by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the department",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Department details",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/Department")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Department not found",
     *         @OA\JsonContent(ref="#/components/schemas/NotFoundError")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(ref="#/components/schemas/InternalServerError")
     *     ),
     *     security={ {"bearerAuth": {}} },
     *     tags={"Departments"}
     * )
     */
    public function show(string $id)
    {
        $department = $this->repository->findOrFail($id);
        return new DepartmentResource($department);
    }

    /**
     * @OA\Put(
     *     path="/api/departments/{id}",
     *     summary="Update a department by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the department",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Department object that needs to be updated",
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="HR Department")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Department details",
     *         @OA\JsonContent(
     *             @OA\Property(property="data", ref="#/components/schemas/Department")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Department not found",
     *         @OA\JsonContent(ref="#/components/schemas/NotFoundError")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation errors",
     *         @OA\JsonContent(
     *             @OA\Property(property="errors", type="object", example={"name": {"The name field is required."}})
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(ref="#/components/schemas/InternalServerError")
     *     ),
     *     security={ {"bearerAuth": {}} },
     *     tags={"Departments"}
     * )
     */
    public function update(DepartmentRequest $request, string $id)
    {
        $department = $this->repository->findOrFail($id);
        $department->update($request->validated());
        return new DepartmentResource($department);
    }

    /**
     * @OA\Delete(
     *     path="/api/departments/{id}",
     *     summary="Delete a department by ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID of the department",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Department deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Department not found",
     *         @OA\JsonContent(ref="#/components/schemas/NotFoundError")
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error",
     *         @OA\JsonContent(ref="#/components/schemas/InternalServerError")
     *     ),
     *     security={ {"bearerAuth": {}} },
     *     tags={"Departments"}
     * )
     */
    public function destroy(string $id)
    {
        $department = $this->repository->findOrFail($id);
        $department->delete();
        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
