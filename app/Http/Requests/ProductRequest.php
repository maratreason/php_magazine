<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'code' => 'required|min:3|max:255|unique:categories,code',
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:5',
            'price' => 'required|numeric|min:1'
        ];

        if ($this->route()->named('products.update')) {
            $rules['code'] .= ',' . $this->route()->parameter('product')->id;
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно для ввода',
            'min' => 'Поле :attribute должно иметь минимум :min символов',
            'code.required' => 'Поле "Код" обязательно для ввода',
            'name.required' => 'Поле "Название" обязательно для ввода',
            'description.required' => 'Поле "Описание" обязательно для ввода',
            'price.required' => 'Поле "Цена" обязательно для ввода',
            'code.min' => 'Поле "Код" должно содержать не менее :min символов',
            'name.min' => 'Поле "Название" должно содержать не менее :min символов',
            'description.min' => 'Поле "Описание" должно содержать не менее :min символов',
            'price.numeric' => 'Поле "Цена" должно содержать только числовые значения',
        ];
    }
}
