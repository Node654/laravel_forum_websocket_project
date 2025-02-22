<?php

namespace App\Http\Requests\Branch;

use App\Services\Branch\DTO\BranchData;
use Illuminate\Foundation\Http\FormRequest;

class StoreParentBranchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return ! auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'parent_id' => 'required|integer|exists:branches,id',
            'section_id' => 'required|integer|exists:sections,id',
            'title' => 'required|string|min:3|unique:branches,title',
        ];
    }

    public function parentBranchData(): BranchData
    {
        return BranchData::from($this->validated());
    }
}
