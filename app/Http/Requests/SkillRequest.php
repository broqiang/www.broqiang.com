<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
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
        return [
            'name'        => 'required|string|between:2,20',
            'description' => 'string|between:5,255',
            'sort'        => 'nullable|integer|between:1,200',
        ];
    }

    public function messages()
    {
        return [
            'sort.integer' => '排序必须是正整数',
            'sort.between' => '排序必须是 1-200 之间的整数',
        ];
    }
}
