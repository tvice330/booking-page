<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'email' => ['required','email','max:255'],
            'phone_number' => 'required|regex:/^(\+)?([0-9]){1,19}$/i',
            'arrival_date' => 'required|date',
            'departure_date' => 'required|date',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => __('Це поле обов\'язкове'),
            'email.email' => __('Введіть дійсну електронну адресу'),
            'email.max' => __('Дозволено тільки 255 символів'),

            'arrival_date.required' => __('Це поле обов\'язкове'),
            'arrival_date.date' => __('Невірний формат дати'),

            'departure_date.required' => __('Це поле обов\'язкове'),
            'departure_date.date' => __('Невірний формат дати'),

            'phone_number.required' => __('Це поле обов\'язкове'),
            'phone_number.date' => __('Невірний формат телефону'),
        ];
    }
}

