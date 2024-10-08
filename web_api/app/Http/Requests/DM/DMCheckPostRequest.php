<?php

namespace App\Http\Requests\DM;

use Illuminate\Foundation\Http\FormRequest;

class DMCheckPostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email|exists:d_m_s,email',
            'password' => 'required|min:5|max:30',
        ];
    }
}
