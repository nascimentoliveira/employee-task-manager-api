<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @OA\Schema(
 *     schema="Task",
 *     title="Task",
 *     description="Task model representing a task entity.",
 *     @OA\Property(property="id", type="integer", format="int64", description="Task ID", example="1"),
 *     @OA\Property(property="title", type="string", description="Task title", example="Complete Project Report"),
 *     @OA\Property(property="description", type="string", description="Task description (optional)", example="Finish writing the project report"),
 *     @OA\Property(property="assignee_id", type="integer", format="int64", description="ID of the assigned employee", example="1"),
 *     @OA\Property(property="due_date", type="string", format="date-time", description="Due date for the task (optional)", example="2023-08-15T10:00:00Z"),
 *     @OA\Property(property="created_at", type="string", format="date-time", description="Date and time when the task was created", example="2023-08-01T01:41:44.000000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", description="Date and time of the last update to the task", example="2023-08-01T02:15:10.000000Z"),
 * )
 *
 * @OA\Schema(
 *     schema="TaskRequest",
 *     title="Task Request",
 *     description="Task model for request body",
 *     @OA\Property(property="title", type="string", description="Task title", example="Complete Project Report"),
 *     @OA\Property(property="description", type="string", description="Task description (optional)", example="Finish writing the project report"),
 *     @OA\Property(property="assignee_id", type="integer", format="int64", description="ID of the assigned employee", example="1"),
 *     @OA\Property(property="due_date", type="string", format="date-time", description="Due date for the task (optional)", example="2023-08-15T10:00:00Z"),
 * )
 */

class Task extends Model
{   
    protected $fillable = [
        'title',
        'description',
        'assignee_id',
        'due_date',
    ];

    use HasFactory;
}
