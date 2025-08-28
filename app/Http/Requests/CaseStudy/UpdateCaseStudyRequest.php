<?php
namespace App\Http\Requests\CaseStudy;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateCaseStudyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // You can add specific authorization logic here if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'required|string|max:255',
            'description' => 'required|string',
            'age' => 'required|integer|min:0|max:150',
            'gender' => 'required|in:male,female,other',
            'medical_history' => 'required|string',
            'presenting_symptoms' => 'required|string',
            'duration_of_symptoms' => 'required|string|max:255',
            'risk_factor' => 'required|string',
            'outcome' => 'nullable|string',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
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
            'title.required' => 'The title field is required.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'age.integer' => 'The age must be a number.',
            'age.min' => 'The age must be at least 0.',
            'age.max' => 'The age may not be greater than 150.',
            'gender.in' => 'The gender must be male, female, or other.',
            'image.image' => 'The file must be an image.',
            'image.mimes' => 'The image must be a file of type: jpeg, png, jpg, gif, webp.',
            'image.max' => 'The image may not be greater than 2MB.',
        ];
    }
}
