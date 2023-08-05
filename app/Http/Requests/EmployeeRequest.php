<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;

class EmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isUpdating = $this->isMethod('PUT') || $this->isMethod('PATCH');
        $employeeId = $this->route('employee');

        $rules = [
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'phone' => 'nullable|string',
            'department_id' => 'required|exists:departments,id',
        ];

        if ($isUpdating && $employeeId !== null) {
            $rules['email'] = [
                'required',
                'email',
                Rule::unique('employees')->ignore($employeeId),
            ];
        } else {
            $rules['email'] = 'required|email|unique:employees';
        }

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
