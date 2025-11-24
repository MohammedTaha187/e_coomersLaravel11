<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreorderRequest extends FormRequest
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
            'order_number' => 'required',
            'user_id' => 'required',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'subtotal' => 'required|numeric',
            'tax' => 'required|numeric',
            'total' => 'required|numeric',
            'status' => 'required|string|max:255',
            'ordered_date' => 'required|date',
            'total_items' => 'required|numeric',
            'delivered_date' => 'required|date',
            'discount' => 'required|numeric',
            'payment_mode' => 'required|string|max:255',
            'shipping_firstname' => 'required|string|max:255',
            'shipping_lastname' => 'required|string|max:255',
            'shipping_email' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:255',
            'shipping_address' => 'required|string|max:255',
            'shipping_city' => 'required|string|max:255',
            'shipping_state' => 'required|string|max:255',
            'shipping_zipcode' => 'required|string|max:255',

        ];
    }
}
