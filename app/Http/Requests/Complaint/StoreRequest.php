<?php

namespace App\Http\Requests\Complaint;

use App\Services\Message\DTO\StoreComplaintData;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'theme_id' => ['required', 'int', 'exists:themes,id'],
            'body' => ['required', 'string'],
        ];
    }

    public function dataComplaint(): StoreComplaintData
    {
        return StoreComplaintData::from($this->validated());
    }
}
