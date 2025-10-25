<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
{
    /**
     * لتحديد من يمكنه إرسال هذا الطلب
     */
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:100|unique:categories,name',
            'description' => 'nullable|string|max:500',
            'is_active' => 'nullable|boolean',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'اسم الفئة مطلوب.',
            'name.string' => 'يجب أن يكون اسم الفئة نصاً.',
            'name.min' => 'اسم الفئة يجب ألا يقل عن 3 أحرف.',
            'name.max' => 'اسم الفئة يجب ألا يتجاوز 100 حرف.',
            'name.unique' => 'اسم الفئة مستخدم بالفعل، يرجى اختيار اسم آخر.',
            'description.string' => 'الوصف يجب أن يكون نصياً.',
            'description.max' => 'الوصف يجب ألا يتجاوز 500 حرف.',
            'is_active.boolean' => 'قيمة التفعيل غير صحيحة.',
            'image.image' => 'الملف المرفق يجب أن يكون صورة.',
            'image.mimes' => 'أنواع الصور المسموح بها: jpg, jpeg, png, webp.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
        ];
    }
}
