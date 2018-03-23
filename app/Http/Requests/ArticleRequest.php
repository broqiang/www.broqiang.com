<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
        if ($this->method() === 'PATCH') {
            return ['body' => 'required|string'];
        }

        return [
            'title' => 'required|string|between:2,30',
            'slug'  => [
                'nullable',
                'regex:/^[a-zA-Z0-9_-]+$/u',
            ],
            'sort'  => 'nullable|integer|between:1,99999',
        ];
    }

    public function messages()
    {
        return [
            'sort.integer'  => '排序必须是正整数',
            'sort.between'  => '排序必须是 1-99999 之间的整数',
            'body.required' => '文档没有任何内容需要保存！',
        ];
    }
}
