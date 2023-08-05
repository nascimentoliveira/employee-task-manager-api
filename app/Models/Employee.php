<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Employee",
 *     title="Employee",
 *     description="Employee model",
 *     @OA\Property(property="id", type="integer", format="int64", description="Employee ID", example="1"),
 *     @OA\Property(property="firstName", type="string", description="Employee's first name", example="John"),
 *     @OA\Property(property="lastName", type="string", description="Employee's last name", example="Doe"),
 *     @OA\Property(property="email", type="string", description="Employee's email address", example="john.doe@example.com"),
 *     @OA\Property(property="phone", type="string", description="Employee's phone number", example="+1 (123) 456-7890"),
 *     @OA\Property(property="department_id", type="integer", format="int64", description="ID of the department to which the employee belongs", example="1"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Employee creation date", example="2023-08-01T01:41:44.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Date of last employee update", example="2023-08-01T02:15:10.000000Z"),
 * )
 */

class Employee extends Model
{
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'phone',
        'department_id',
    ];

    use HasFactory;
}
