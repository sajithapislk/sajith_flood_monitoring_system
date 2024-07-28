<?php

namespace App\Http\Requests\RiskUser;

use App\Models\RiskUser;
use Illuminate\Foundation\Http\FormRequest;

class RiskUserStorePostRequest extends FormRequest
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
            'monitor_place_id' => 'required|exists:monitor_places,id',
            'latitude' => 'required',
            'longitude' => 'required',
            'distance' => 'required',
        ];
    }
}
