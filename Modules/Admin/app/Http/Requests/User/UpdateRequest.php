<?php

declare(strict_types=1);

namespace Modules\Admin\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:40'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($this->user, 'uuid')->whereNull('deleted_at')],
            'status' => ['required', 'in:1,2'],
            'role' => ['required', 'in:1,2,3'],
            'address' => ['required', 'exists:address,id'],
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
