<?php

namespace App\Http\Requests\Facturis\Try;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TryFormRequest extends FormRequest
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
        $cloudFlare = app()->isProduction() ? Rule::turnstile() : '';

        return [
            'full_name' => ['required', 'string', 'max:200'],
            'email' => ['required', 'email:rfc', 'unique:clients', 'max:200'],
            'telephone' => ['required', 'phone:MA', 'unique:clients', 'max:40'],
            'country' => ['required', 'integer', 'exists:countries,id'],
            'city' => ['required', 'string', 'max:100'],
            'address' => ['required', 'string'],

            'business_name' => ['required', 'string', 'max:200', 'unique:clients'],
            'ice' => ['nullable', 'numeric', 'digits_between:9,40', 'unique:clients'],
            'website' => ['nullable', 'string', 'unique:clients', 'max:200'],
            'pack' => ['required', 'uuid', 'exists:plans,uuid'],

            'cf-turnstile-response' => [Rule::requiredIf(app()->isProduction()), $cloudFlare],
        ];
    }

    public function attributes()
    {
        return [
            'pack' => 'Plan',
            'cf-turnstile-response' => 'Vérification humaine',
        ];
    }
}
