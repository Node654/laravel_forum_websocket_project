<?php

namespace App\Http\Requests\Theme;

use App\Services\Theme\DTO\StoreThemeData;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'description' => 'nullable|string|max:255',
            'branch_id' => 'required|integer|exists:branches,id',
        ];
    }

    public function themeData(): StoreThemeData
    {
        return StoreThemeData::from($this->validated());
    }
}
