<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Department",
 *     title="Department",
 *     description="Department model representing a department entity.",
 *     @OA\Property(property="id", type="integer", format="int64", description="Department ID", example="1"),
 *     @OA\Property(property="name", type="string", description="Department name", example="HR Department"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Department creation date", example="2023-08-01T01:41:44.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Date of last department update", example="2023-08-01T02:15:10.000000Z"),
 * )
 *
 * @OA\Schema(
 *     schema="DepartmentRequest",
 *     title="Department Request",
 *     description="Department model for request body",
 *     @OA\Property(property="name", type="string", description="Department name", example="HR Department"),
 * )
 */


class Department extends Model
{
    protected $fillable = [
        'name',
    ];

    public function employee()
    {
        return $this->hasMany(Employee::class, 'department_id', 'id');
    }

    use HasFactory;
}
