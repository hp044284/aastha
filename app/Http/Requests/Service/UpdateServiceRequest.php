<?php
namespace App\Http\Requests\Service;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateServiceRequest extends FormRequest
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
            'icon' => ['nullable', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'meta_title' => ['nullable', 'string', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:service_categories,id'],
            'meta_keyword' => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:1000'],
            'file_name' => ['nullable', 'file', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:2048'],
            'description' => ['required', 'string'],
            'faqs' => ['nullable', 'array'],
            'faqs.*.question' => ['required_with:faqs', 'string', 'max:1000'],
            'faqs.*.answer' => ['required_with:faqs', 'string', 'max:5000'],
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
            'title.required' => 'The service title is required.',
            'title.string' => 'The service title must be a string.',
            'title.max' => 'The service title may not be greater than 255 characters.',
            'meta_title.string' => 'The meta title must be a string.',
            'meta_title.max' => 'The meta title may not be greater than 255 characters.',
            'category_id.required' => 'The category is required.',
            'category_id.integer' => 'The category must be a valid selection.',
            'category_id.exists' => 'The selected category does not exist.',
            'meta_keyword.string' => 'The meta keyword must be a string.',
            'meta_keyword.max' => 'The meta keyword may not be greater than 255 characters.',
            'meta_description.string' => 'The meta description must be a string.',
            'meta_description.max' => 'The meta description may not be greater than 1000 characters.',
            'file_name.file' => 'The profile image must be a file.',
            'file_name.mimes' => 'The profile image must be a file of type: jpeg, png, jpg, gif, svg, webp.',
            'file_name.max' => 'The profile image may not be greater than 2MB.',
            'description.required' => 'The description is required.',
            'description.string' => 'The description must be a string.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) 
        {
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
