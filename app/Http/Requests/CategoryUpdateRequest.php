<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:categories,name,' . $this->route('category'),
            'slug' => 'nullable|string|max:255|unique:categories,slug,' . $this->route('category'),
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required' => 'يجب إدخال اسم التصنيف.',
            'name.string' => 'اسم التصنيف يجب أن يكون نصًا.',
            'name.max' => 'اسم التصنيف يجب ألا يتجاوز 255 حرفًا.',
            'name.unique' => 'اسم التصنيف مستخدم بالفعل.',

            'slug.string' => 'الرابط المختصر يجب أن يكون نصًا.',
            'slug.max' => 'الرابط المختصر يجب ألا يتجاوز 255 حرفًا.',
            'slug.unique' => 'الرابط المختصر مستخدم بالفعل.',

            'description.string' => 'الوصف يجب أن يكون نصًا.',
            'description.max' => 'الوصف يجب ألا يتجاوز 1000 حرف.',

            'image.image' => 'الملف المرفق يجب أن يكون صورة.',
            'image.mimes' => 'يجب أن تكون الصورة بصيغة: jpeg, png, jpg, أو webp.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
        ];
    }
}
