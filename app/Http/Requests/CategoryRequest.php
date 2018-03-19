<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CategoryRequest extends FormRequest
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
        $validate = [
            'name'        => 'required|string|between:2,20|unique:categories',
            'description' => 'string|between:5,255',
            'sort'        => 'nullable|integer|between:1,200',
        ];


        if ($this->method() === 'PUT') {
            $validate['name'] = 'required|string|between:2,20|unique:categories,name,' .  $this->category->id;
        }

        return $validate;
    }

    public function messages()
    {
        return [
            'sort.integer' => '排序必须是正整数',
            'sort.between' => '排序必须是 1-200 之间的整数',
        ];
    }
}
