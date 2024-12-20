<?php

namespace App\Http\Requests\Message;

use App\Services\Message\DTO\StoreMessageData;
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
            'body' => 'required|string|max:255',
            'theme_id' => 'required|integer|exists:themes,id'
        ];
    }

    public function messageData(): StoreMessageData
    {
        $data = $this->validated();
        $data['user_id'] = auth()->id();
        return StoreMessageData::from($data);
    }
}
