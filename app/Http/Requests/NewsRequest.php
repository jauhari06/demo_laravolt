<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class NewsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::check();
    }

    protected function prepareForValidation(): void
{
    if ($this->filled('published_at')) {
        try {
            Carbon::setLocale('id');
            \Locale::setDefault('id_ID');

            $converted = Carbon::createFromFormat('d F Y H:i', $this->published_at, 'Asia/Jakarta')
                ->toDateTimeString();

            $this->merge([
                'published_at' => $converted,
            ]);
        } catch (\Exception $e) {
        }
    }
}

    public function rules(): array
    {

        // dd($this->all());

        $newsId = optional($this->route('news'))->id; 
        
        return [
            'title' => ['required', 'string', 'max:255'],

            'slug' => [
                'required', 
                'string', 
                'max:255', 
                'alpha_dash', 
                Rule::unique('news', 'slug')->ignore($newsId, 'id')
            ],
            
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'date'],
            'image' => ['nullable', 'string', 'mimes:jpg,png', 'max:5120'],
            'topic_id' => ['required', 'exists:topics,id'],
        ];
    }
}
