<?php

namespace App\Http\Requests\User;

use App\Services\User\DTO\UpdatePersonalData;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePersonalRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'avatar' => 'required|file',
        ];
    }

    public function personalData(): UpdatePersonalData
    {
        return UpdatePersonalData::from($this->validated());
    }
}
