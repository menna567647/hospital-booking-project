<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class DoctorScheduleRequest extends FormRequest
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
            'doctor_id' => 'required|exists:doctors,id',
            'day' => 'required|string',
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
        ];
    }
    public function messages()
    {
        if (app()->getLocale() === 'ar') {
            return [
                'doctor_id.required' => 'حقل أسم الدكتور مطلوب',
                'day.required' => 'حقل اليوم مطلوب',
                'start_time.required' => 'حقل وقت البداية مطلوب',
                'end_time.required' => 'حقل وقت النهاية مطلوب',
                'end_time.after' => 'وقت النهاية يجب أن يكون بعد وقت البداية',
            ];
        }

        return [
            'doctor_id.required' => 'Doctor Name field is required',
            'end_time.after' => 'End time must be after start time',
        ];
    }
}
