<?php

namespace App\Http\Requests;

use App\Rules\IntlPhoneNumberRule;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property int $id
 */
class GuestUpdateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required', 'integer'],
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => [
                'nullable', 'string', 'email', 'max:255',
                Rule::unique('guests', 'email')->ignore($this->get('id'))
            ],
            'phone_number' => [
                'required', 'string', 'max:255',
                new IntlPhoneNumberRule(),
                Rule::unique('guests', 'phone_number')->ignore($this->get('id'))
            ],
            'country' => ['string', 'max:255'],
        ];
    }
}
