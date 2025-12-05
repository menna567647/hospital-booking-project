<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class RoleRequest extends FormRequest
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
            'name' =>
            [
                'required',
                Rule::unique(Role::class)->ignore($this->route('id')),
            ],
            'permissions' => 'required|array',
            'permissions.*' => 'exists:permissions,name',
        ];
    }

    public function messages()
    {
        if (app()->getLocale() === 'ar') {
            return [
                'name.required' => 'حقل اسم الدور مطلوب',
                'name.unique' => 'اسم الدور مستخدم بالفعل',
                'permissions.required' => 'يجب اختيار صلاحيات على الأقل',
            ];
        }
        return [
            'permissions.required' => 'You must select at least one permission.',
            'permissions.*.exists' => 'One or more selected permissions are invalid.',
        ];
    }
}
