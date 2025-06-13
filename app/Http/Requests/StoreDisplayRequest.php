<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request: StoreDisplayRequest
 *
 * Handles validation for creating a new display.
 */
class StoreDisplayRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * Always true, as policies handle authorization.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Validation rules for creating a display.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price_per_day' => 'required|numeric|min:0',
            'resolution_height' => 'required|integer|min:1',
            'resolution_width' => 'required|integer|min:1',
            'type' => 'required|in:indoor,outdoor',
        ];
    }
}
