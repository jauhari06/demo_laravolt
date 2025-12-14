<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNewsRequest extends FormRequest
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
            'title'        => 'sometimes|required|string|max:255',
            'content'      => 'sometimes|required|string',
            'topic_id'     => 'sometimes|required|exists:topics,id',
            'status'       => 'sometimes|in:DRAFT,PUBLISHED,ARCHIVED',
            'image'        => 'sometimes|nullable|image|max:2048',
            'published_at' => 'sometimes|nullable|date',
        ];
    }
}
