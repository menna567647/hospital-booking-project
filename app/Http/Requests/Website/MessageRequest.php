<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'title' => 'required|string|max:100',
            'text' => 'required|string',
            'client_id' => 'nullable|exists:clients,id',
        ];
    }

    public function messages(): array
    {
        if (app()->getLocale() === 'ar') {
            return [
                'name.required'   => 'حقل الاسم مطلوب.',
                'email.required'  => 'حقل البريد الإلكتروني مطلوب.',
                'email.email'     => 'يرجى إدخال بريد إلكتروني صالح.',
                'phone.required'  => 'حقل رقم الهاتف مطلوب.',
                'title.required'  => 'حقل عنوان الرسالة مطلوب.',
                'title.max'       => 'عنوان الرسالة يجب ألا يزيد عن 100 حرف.',
                'text.required'   => 'حقل نص الرسالة مطلوب.',
            ];
        }
        return [];
    }
}