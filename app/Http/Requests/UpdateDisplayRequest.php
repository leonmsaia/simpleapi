<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request: UpdateDisplayRequest
 *
 * Handles validation for updating an existing display.
 */
class UpdateDisplayRequest extends FormRequest
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
     * Validation rules for updating a display.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'price_per_day' => 'sometimes|required|numeric|min:0',
            'resolution_height' => 'sometimes|required|integer|min:1',
            'resolution_width' => 'sometimes|required|integer|min:1',
            'type' => 'sometimes|required|in:indoor,outdoor',
        ];
    }
}
