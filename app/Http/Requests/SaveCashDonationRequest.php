<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCashDonationRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'amount' => ['required', 'numeric', 'min:1'],
            'drop_off_date' => ['required', 'date', 'after_or_equal:today'],
            'drop_off_time' => ['required', 'date_format:H:i'],
            'drop_off_address' => ['required', 'string', 'max:500'],
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'Please enter the donation amount.',
            'amount.numeric' => 'The donation amount must be a number.',
            'drop_off_date.required' => 'Please select a drop-off date.',
            'drop_off_date.after_or_equal' => 'The drop-off date cannot be in the past.',
            'drop_off_time.required' => 'Please select a drop-off time.',
            'drop_off_time.date_format' => 'The drop-off time must be in the format HH:MM.',
            'drop_off_address.required' => 'Please provide a drop-off address.',
        ];
    }
}
