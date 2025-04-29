<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'address' => ['required'],
            'user_uuid' => ['required', 'exists:users,uuid'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
