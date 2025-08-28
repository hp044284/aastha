<?php
namespace App\Http\Requests\News;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreNewsRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'news_url' => 'nullable|url|max:500',
            'video_url' => 'nullable|url|max:500',
            'file_name' => 'nullable|file|mimes:pdf,jpg,jpeg,png,gif,webp|max:10240', 
            'event_id' => 'nullable|exists:events,id',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'The news title is required.',
            'title.max' => 'The news title may not be greater than 255 characters.',
            'subtitle.max' => 'The subtitle may not be greater than 255 characters.',
            'news_url.url' => 'The news URL must be a valid URL.',
            'news_url.max' => 'The news URL may not be greater than 500 characters.',
            'video_url.url' => 'The video URL must be a valid URL.',
            'video_url.max' => 'The video URL may not be greater than 500 characters.',
            'file_name.max' => 'The file name may not be greater than 255 characters.',
            'file_type.max' => 'The file type may not be greater than 100 characters.',
            'event_id.exists' => 'The selected event does not exist.',
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
