<?php

namespace App\Http\Requests\Theme;

use App\Services\Theme\DTO\UpdateThemeData;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:255'
        ];
    }

    public function themeData(): UpdateThemeData
    {
        return UpdateThemeData::from($this->validated());
    }
}
