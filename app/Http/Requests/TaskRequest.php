<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class TaskRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
     {
        $rules = [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'assignee_id' => 'required|exists:employees,id',
            'due_date' => 'nullable|date',
        ];

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse(
            ['errors' => $validator->errors()],
            Response::HTTP_UNPROCESSABLE_ENTITY,
        );;

        throw new HttpResponseException($response);
    }
}
