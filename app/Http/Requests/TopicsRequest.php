<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class TopicsRequest extends FormRequest
{
    public function authorize(): bool
    {
        
        return true;
    }

    public function rules(): array
    {
        $topicId = $this->route('topic')?->id;

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('topics', 'name')->ignore($topicId),
            ],
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[a-z0-9-]+$/', 
                Rule::unique('topics', 'slug')->ignore($topicId),
            ],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->has('name') && !$this->filled('slug')) {
            $this->merge([
                'slug' => Str::slug($this->input('name')),
            ]);
        }
    }
}