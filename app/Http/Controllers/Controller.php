<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     title="Employee Task Manager API",
 *     version="1.0.0",
 *     description="The Task and Employee Management API"
 * )
 *
 * @OA\Schema(
 *     schema="PaginationMeta",
 *     title="Pagination Meta",
 *     description="Pagination meta information",
 *     @OA\Property(property="current_page", type="integer", description="Current page number", example=3),
 *     @OA\Property(property="from", type="integer", description="Starting record number", example=31),
 *     @OA\Property(property="last_page", type="integer", description="Last page number", example=5),
 *     @OA\Property(property="path", type="string", description="URL of the current page", example="https://example.com/api/departments"),
 *     @OA\Property(property="per_page", type="integer", description="Number of records per page", example=15),
 *     @OA\Property(property="to", type="integer", description="Ending record number", example=45),
 *     @OA\Property(property="total", type="integer", description="Total number of records", example=15),
 *             ),
 * )
 *
 * @OA\Schema(
 *     schema="PaginationLinks",
 *     title="Pagination Links",
 *     description="Pagination links",
 *     @OA\Property(property="first", type="string", example="https://example.com/api/departments?page=1"),
 *     @OA\Property(property="last", type="string", example="https://example.com/api/departments?page=5"),
 *     @OA\Property(property="prev", type="string", example="https://example.com/api/departments?page=2"),
 *     @OA\Property(property="next", type="string", example="https://example.com/api/departments?page=4"),
 * )
 * 
 * @OA\Schema(
 *     schema="NotFoundError",
 *     title="Not Found Error",
 *     description="Response for resource not found errors",
 *     @OA\Property(property="error_code", type="integer", format="int32", example=404),
 *     @OA\Property(property="timestamp", type="integer", format="int64", example=1678905678),
 *     @OA\Property(property="message", type="string", example="Resource not found")
 * )
 * 
 * @OA\Schema(
 *     schema="InternalServerError",
 *     title="Internal Server Error",
 *     description="Response for internal server errors",
 *     @OA\Property(property="error_code", type="integer", format="int32", example=500),
 *     @OA\Property(property="timestamp", type="integer", format="int64", example=1678905678),
 *     @OA\Property(property="message", type="string", example="Internal server error")
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
