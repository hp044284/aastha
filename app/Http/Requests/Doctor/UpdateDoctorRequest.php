<?php
namespace App\Http\Requests\Doctor;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateDoctorRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about_us' => 'nullable|string',
            'affiliation' => 'nullable|string|max:255',
            'position_id' => 'required|exists:positions,id',
            'education' => 'nullable|array',
            'education.*.degree' => 'required|string|max:255',
            'education.*.institution' => 'required|string|max:255',
            'education.*.start_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'education.*.end_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'positions' => 'nullable|array',
            'positions.*.position_title' => 'required|string|max:255',
            'positions.*.organization' => 'required|string|max:255',
            'positions.*.start_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'positions.*.end_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'affiliations' => 'nullable|array',
            'affiliations.*.organization' => 'required|string|max:255',
            'affiliations.*.affiliation_type' => 'required|string|max:255',
            'affiliations.*.role_title' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'The doctor name is required.',
            'image.image' => 'The profile image must be an image file.',
            'image.mimes' => 'The profile image must be a file of type: jpeg, png, jpg, gif, svg.',
            'image.max' => 'The profile image may not be greater than 2MB.',
            'about_us.string' => 'The about us field must be a string.',
            'affiliation.string' => 'The affiliation must be a string.',
            'affiliation.max' => 'The affiliation may not be greater than 255 characters.',
            'position_id.required' => 'The position is required.',
            'position_id.exists' => 'The selected position is invalid.',

            // Education
            'education.*.degree.required' => 'The degree field is required for each education entry.',
            'education.*.degree.string' => 'The degree must be a string.',
            'education.*.degree.max' => 'The degree may not be greater than 255 characters.',
            'education.*.institution.required' => 'The institution field is required for each education entry.',
            'education.*.institution.string' => 'The institution must be a string.',
            'education.*.institution.max' => 'The institution may not be greater than 255 characters.',
            'education.*.start_year.integer' => 'The start year must be an integer.',
            'education.*.start_year.min' => 'The start year must be at least 1900.',
            'education.*.start_year.max' => 'The start year may not be greater than the current year.',
            'education.*.end_year.integer' => 'The end year must be an integer.',
            'education.*.end_year.min' => 'The end year must be at least 1900.',
            'education.*.end_year.max' => 'The end year may not be greater than the current year.',

            // Positions
            'positions.*.position_title.required' => 'The position title is required for each position entry.',
            'positions.*.position_title.string' => 'The position title must be a string.',
            'positions.*.position_title.max' => 'The position title may not be greater than 255 characters.',
            'positions.*.organization.required' => 'The organization is required for each position entry.',
            'positions.*.organization.string' => 'The organization must be a string.',
            'positions.*.organization.max' => 'The organization may not be greater than 255 characters.',
            'positions.*.start_year.integer' => 'The start year must be an integer.',
            'positions.*.start_year.min' => 'The start year must be at least 1900.',
            'positions.*.start_year.max' => 'The start year may not be greater than the current year.',
            'positions.*.end_year.integer' => 'The end year must be an integer.',
            'positions.*.end_year.min' => 'The end year must be at least 1900.',
            'positions.*.end_year.max' => 'The end year may not be greater than the current year.',

            // Affiliations
            'affiliations.*.organization.required' => 'The organization is required for each affiliation entry.',
            'affiliations.*.organization.string' => 'The organization must be a string.',
            'affiliations.*.organization.max' => 'The organization may not be greater than 255 characters.',
            'affiliations.*.affiliation_type.required' => 'The affiliation type is required for each affiliation entry.',
            'affiliations.*.affiliation_type.string' => 'The affiliation type must be a string.',
            'affiliations.*.affiliation_type.max' => 'The affiliation type may not be greater than 255 characters.',
            'affiliations.*.role_title.required' => 'The role title is required for each affiliation entry.',
            'affiliations.*.role_title.string' => 'The role title must be a string.',
            'affiliations.*.role_title.max' => 'The role title may not be greater than 255 characters.',
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
