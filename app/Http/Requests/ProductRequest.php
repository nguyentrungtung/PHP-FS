<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'product_name' => 'required|string|max:255',
            'product_price' => 'required|numeric|min:0',
            'product_quantity' => 'required|numeric|min:0',
            'product_price_old' => 'nullable|numeric|min:0',
            'product_description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục đã chọn không hợp lệ.',
            'brand_id.required' => 'Vui lòng chọn thương hiệu.',
            'brand_id.exists' => 'Thương hiệu đã chọn không hợp lệ.',
            'product_name.required' => 'Vui lòng nhập tên sản phẩm.',
            'product_name.max' => 'Tên sản phẩm không được vượt quá 255 ký tự.',
            'product_price.required' => 'Vui lòng nhập giá sản phẩm.',
            'product_price.numeric' => 'Giá sản phẩm phải là một số.',
            'product_price.min' => 'Giá sản phẩm không được nhỏ hơn 0.',
            'product_price_old.numeric' => 'Giá cũ phải là một số.',
            'product_price_old.min' => 'Giá cũ không được nhỏ hơn 0.',
            'product_description.string' => 'Mô tả sản phẩm phải là chuỗi ký tự hợp lệ.',
            'product_quantity.required' => 'Vui lòng nhập số lượng sản phẩm.',
            'product_quantity.numeric' => 'Số lượng sản phẩm phải là một số.',
        ];
    }
}
