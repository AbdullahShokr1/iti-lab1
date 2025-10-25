<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255|unique:products,name',
            'slug' => 'nullable|string|max:255|unique:products,slug',
            'description' => 'nullable|string|max:2000',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'يجب إدخال اسم المنتج.',
            'name.string' => 'اسم المنتج يجب أن يكون نصًا.',
            'name.max' => 'اسم المنتج يجب ألا يتجاوز 255 حرفًا.',
            'name.unique' => 'اسم المنتج مستخدم بالفعل.',

            'slug.string' => 'الرابط المختصر يجب أن يكون نصًا.',
            'slug.max' => 'الرابط المختصر يجب ألا يتجاوز 255 حرفًا.',
            'slug.unique' => 'الرابط المختصر مستخدم بالفعل.',

            'description.string' => 'الوصف يجب أن يكون نصًا.',
            'description.max' => 'الوصف يجب ألا يتجاوز 2000 حرف.',

            'price.required' => 'يجب إدخال سعر المنتج.',
            'price.numeric' => 'السعر يجب أن يكون رقمًا.',
            'price.min' => 'السعر يجب ألا يكون أقل من صفر.',

            'stock.required' => 'يجب تحديد كمية المخزون.',
            'stock.integer' => 'المخزون يجب أن يكون رقمًا صحيحًا.',
            'stock.min' => 'المخزون يجب ألا يكون أقل من صفر.',

            'category_id.required' => 'يجب اختيار تصنيف للمنتج.',
            'category_id.exists' => 'التصنيف المحدد غير موجود.',

            'image.image' => 'الملف المرفق يجب أن يكون صورة.',
            'image.mimes' => 'يجب أن تكون الصورة بصيغة: jpeg, png, jpg, أو webp.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
        ];
    }
}
