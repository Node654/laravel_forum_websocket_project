<?php

namespace App\Http\Requests\Branch;

use App\Services\Branch\DTO\BranchData;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'title' => 'required|string|min:3',
            'section_id' => 'required|int|exists:sections,id',
            'parent_id' => 'nullable|int|exists:branches,id',
        ];
    }

    public function branchData(): BranchData
    {
        return BranchData::from($this->validated());
    }
}
