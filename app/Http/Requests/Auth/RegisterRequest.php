<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:clients,email',
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'phone' => 'required|unique:clients,phone',
            'age' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        if (app()->getLocale() === 'ar') {
            return [
                'name.required'               => 'حقل الاسم مطلوب.',
                'phone.required'              => 'حقل رقم الهاتف مطلوب.',
                'phone.unique'                => 'رقم الهاتف مستخدم مسبقاً.',
                'password.required'           => 'حقل كلمة المرور مطلوب.',
                'password.min'                => 'كلمة المرور يجب أن تكون 8 أحرف على الأقل.',
                'password.confirmed'          => 'تأكيد كلمة المرور غير مطابق.',
                'email.required'              => 'حقل البريد الإلكتروني مطلوب.',
                'email.email'                 => 'يرجى إدخال بريد إلكتروني صالح.',
                'email.unique'                => 'البريد الإلكتروني مستخدم مسبقاً.',
                'age.required'                => 'حقل العمر مطلوب.',
                'age.integer'                 => 'يجب أن يكون العمر رقمًا صحيحًا.',
                'age.min'                     => 'العمر يجب أن يكون رقمًا أكبر من الصفر.',
            ];
        }

        return [];
    }
}
