<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class EditOrdertRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "user_id" => "required",
            "status" => "required",
            "payment_method" => "required|in:online, cash on delivery",
            "address" => "required",
            "description" => "nullable"
        ];
    }
}
