<?php

namespace App\Http\Requests\Section;

use App\Services\Section\DTO\SectionData;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|min:3',
        ];
    }

    public function sectionData(): SectionData
    {
        return SectionData::from($this->validated());
    }

    public function messages()
    {
        return [
            'title' => 'Заголовок должен быть!',
        ];
    }
}
