<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PasswordRequest extends FormRequest
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
            'password' => 'required|min:6|confirmed',
        ];
    }
    public function messages()
    {
        if (app()->getLocale() === 'ar') {
            return [
                'password.required' => 'حقل كلمة المرور مطلوب',
                'password.min' => 'يجب أن تتكون كلمة المرور من 6 أحرف على الأقل',
                'password.confirmed' => 'تأكيد كلمة المرور غير مطابق',
            ];
        }
        return [];
    }
}