<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\User;

class UserRequest extends FormRequest
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
            'email' =>
            [
                'required',
                'email',
                Rule::unique(User::class)->ignore($this->id)
            ],
            'password' => 'required|min:6|confirmed',
            'role_name' => 'required|exists:roles,name',
        ];
    }
    public function messages()
    {
        if (app()->getLocale() === 'ar') {
            return [
                'name.required' => 'حقل الاسم مطلوب',
                'email.required' => 'حقل البريد الإلكتروني مطلوب',
                'email.email' => 'يجب إدخال بريد إلكتروني صحيح',
                'email.unique' => 'هذا البريد الإلكتروني مستخدم بالفعل',

                'password.required' => 'حقل كلمة المرور مطلوب',
                'password.min' => 'يجب أن تتكون كلمة المرور من 6 أحرف على الأقل',
                'password.confirmed' => 'تأكيد كلمة المرور غير مطابق',

                'role_id.required' => 'حقل الدور مطلوب',
                'role_id.exists' => 'الدور المحدد غير صالح',
            ];
        }
        return [
            'role_id.required' => 'The role field is required',
            'role_id.exists' => 'The selected role is invalid.',
        ];
    }
}
