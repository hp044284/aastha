<?php

namespace App\Http\Requests\Team;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateTeamRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'file_name' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'experience' => 'nullable|string|max:500',
            'department_id' => 'nullable|exists:departments,id',
            'positions_id' => 'nullable|exists:positions,id',
            'status' => 'nullable|boolean',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The team member name is required.',
            'name.string' => 'The team member name must be a string.',
            'name.max' => 'The team member name may not be greater than 255 characters.',
            
            'file_name.image' => 'The profile image must be an image file.',
            'file_name.mimes' => 'The profile image must be a file of type: jpeg, png, jpg, gif, svg, webp.',
            'file_name.max' => 'The profile image may not be greater than 2MB.',
            
            'experience.string' => 'The experience field must be a string.',
            'experience.max' => 'The experience may not be greater than 500 characters.',
            
            'department_id.exists' => 'The selected department is invalid.',
            'positions_id.exists' => 'The selected position is invalid.',
            
            'status.boolean' => 'The status field must be true or false.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) {
            throw new HttpResponseException(
                response()->json([
                    'status' => 'error',
                    'errors' => $validator->errors(),
                ], 422)
            );
        }
        
        parent::failedValidation($validator);
    }
}
