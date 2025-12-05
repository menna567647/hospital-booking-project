<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Models\Doctor;

class DoctorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'images' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'name' => 'required|string|max:255',
            'department_id' => 'required|exists:departments,id',
            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique(Doctor::class)->ignore($this->route('id')),
            ],
            'consultancy_fees' => 'required|integer',
        ];
    }

    public function messages(): array
    {
        if (app()->getLocale() === 'ar') {
            return [
                'images.required' => 'الصور مطلوبة',
                'images.image' => 'يجب أن يكون الملف صورة',
                'images.mimes' => 'نوع الصورة غير مدعوم',
                'images.max' => 'حجم الصورة كبير جدًا',
                'name.required' => 'حقل الاسم مطلوب',
                'name.string' => 'الاسم يجب أن يكون نصًا',
                'name.max' => 'الاسم طويل جدًا',
                'department_id.required' => 'حقل القسم مطلوب',
                'department_id.exists' => 'القسم غير موجود',
                'phone.required' => 'رقم الهاتف مطلوب',
                'phone.unique' => 'رقم الهاتف مسجل بالفعل',
                'phone.string' => 'رقم الهاتف يجب أن يكون نصًا',
                'phone.max' => 'رقم الهاتف طويل جدًا',
                'consultancy_fees.required' => 'حقل رسوم الاستشارة مطلوب',
                'consultancy_fees.integer' => 'رسوم الاستشارة يجب أن تكون رقمًا',
            ];
        }

        return [

            'department_id.required' => 'Department field is required',
            'department_id.exists' => 'Selected department does not exist',
        ];
    }
}
