<?php

namespace App\Http\Requests\FloodStatus;

use Illuminate\Foundation\Http\FormRequest;

class FloodStatusStorePostRequest extends FormRequest
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
            'water_level' => 'required'
        ];
    }
}
