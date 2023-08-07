<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'assignee' => [
                'id' => $this->assignee->id,
                'firstName' => $this->assignee->firstName,
                'lastName' => $this->assignee->lastName,
                'email' => $this->assignee->email,
                'phone' => $this->assignee->phone,
                'department' => [
                    'id' => $this->assignee->department->id,
                    'name' => $this->assignee->department->name,
                    'created_at' => $this->assignee->department->created_at,
                    'updated_at' => $this->assignee->department->updated_at,
                ],
                'created_at' => $this->assignee->created_at,
                'updated_at' => $this->assignee->updated_at,
            ],
            'due_date' => $this->due_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
