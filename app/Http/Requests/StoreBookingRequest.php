<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'vehicle_id' => 'required|exists:vehicles,id',
            'start_date' => 'required|date|after:today',
            'end_date' => 'required|date|after:start_date',
        ];
    }

    public function messages(): array
    {
        return [
            'vehicle_id.required' => 'A vehicle is required',
        ];
    }
}
