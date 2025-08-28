<?php
namespace App\Http\Requests\Testimonial;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreTestimonialRequest extends FormRequest
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
            'name'           => 'required|string|max:255',
            'city'           => 'nullable|string|max:255',
            'ratting'        => 'nullable|integer|min:1|max:5',
            'message'        => 'nullable|string',
            'treatment'      => 'nullable|string|max:255',
            'treatment_date' => 'nullable|date',
            'image'          => 'nullable|file|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'The name is required.',
            'name.string'        => 'The name must be a valid string.',
            'name.max'           => 'The name may not be greater than 255 characters.',

            'city.string'        => 'The city must be a valid string.',
            'city.max'           => 'The city may not be greater than 255 characters.',

            'ratting.integer'    => 'The rating must be a number.',
            'ratting.min'        => 'The rating must be at least 1.',
            'ratting.max'        => 'The rating may not be greater than 5.',

            'message.string'     => 'The message must be valid text.',

            'treatment.string'   => 'The treatment must be a valid string.',
            'treatment.max'      => 'The treatment may not be greater than 255 characters.',

            'status.boolean'     => 'The status must be true or false.',

            'treatment_date.date'=> 'The treatment date must be a valid date.',

            'image.image'        => 'The file must be an image.',
            'image.mimes'        => 'The image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max'          => 'The image may not be greater than 2 MB.',
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
