<?php

namespace App\Http\Requests;

use App\Models\Donation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDonationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'donor_id' => ['required', 'exists:donors,id'],
            'cause_id' => ['required', 'exists:causes,id'],
            'amount' => ['required', 'numeric', 'gt:0'],
            'donation_mode' => ['required', Rule::in(Donation::DONATION_MODES)],
            'financial_category' => ['required', Rule::in(Donation::FINANCIAL_CATEGORIES)],
            'donation_date' => ['required', 'date', 'before_or_equal:today'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'amount.gt' => 'Donation amount must be greater than zero.',
        ];
    }
}
