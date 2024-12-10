<?php

namespace App\Http\Requests\Branch;

use App\Services\Branch\DTO\BranchData;
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
            'section_id' => 'required|integer|exists:sections,id',
            'parent_id' => 'nullable|integer|exists:branches,id'
        ];
    }

    public function branchData(): BranchData
    {
        return BranchData::from($this->validated());
    }

    public function messages()
    {
        return [
            'title' => 'Заголовок должен быть!',
            'section_id' => 'Необходимо выбрать раздел!'
        ];
    }
}
