<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->route('department');
        
        $rules = [
            'name' => 'required|string',
        ];

        if ($id !== null) {
            $rules['name'] .= ',name,' . $id;
        }

        return $rules;
    }

    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse(
            ['errors' => $validator->errors()],
            Response::HTTP_UNPROCESSABLE_ENTITY,
        );

        throw new HttpResponseException($response);
    }
}
