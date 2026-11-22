<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMediaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $isPatch = $this->isMethod('PATCH') || $this->isMethod('PUT');
        $mediaId = $this->route('medium') ?? $this->route('media');

        return [
            'title' => [
                $isPatch ? 'sometimes' : 'required',
                'string',
                'max:255',
                Rule::unique('media', 'title')->ignore($mediaId),
            ],
            'type' => [$isPatch ? 'sometimes' : 'required', 'in:Anime,Manga'],
            'genre' => [$isPatch ? 'sometimes' : 'required', 'string', 'max:100'],
            'rating' => [$isPatch ? 'sometimes' : 'required', 'numeric', 'min:0', 'max:10'],
            'total_episodes' => [$isPatch ? 'sometimes' : 'required', 'integer', 'min:1'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul media wajib diisi.',
            'title.unique' => 'Judul media sudah terdaftar di FlipPlay.',
            'type.in' => 'Jenis media harus berupa Anime atau Manga.',
            'rating.max' => 'Rating maksimal adalah 10.',
        ];
    }
}
