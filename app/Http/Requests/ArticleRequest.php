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
        $validate = [
            'title' => 'required|string|between:2,30|unique:articles',
            'alias' => 'required|alpha_dash|unique:articles',
            'sort'  => 'nullable|integer|between:1,99999',
        ];

        switch ($this->method()) {
            case 'PUT':
                $validate['title'] = 'required|string|between:2,30|unique:articles,title,' . $this->article->id;
                $validate['alias'] = [
                    'required',
                    'regex:/^[a-zA-Z_-]+$/u',
                    'unique:articles,alias,' . $this->article->id,
                ];
                break;

            case 'PATCH':
                $validate = [
                    'body' => 'required|string',
                ];
                break;
        }

        return $validate;
    }

    public function messages()
    {
        return [
            'alias.required'   => '别名必须填写',
            'alias.regex' => '别名只能由 字母、数字、破折号（ - ）以及下划线（ _ ）组成',
            'alias.unique'     => '别名已经存在，请使用其他名称',
            'sort.integer'     => '排序必须是正整数',
            'sort.between'     => '排序必须是 1-99999 之间的整数',
            'body.required'    => '文档没有任何内容需要保存！',
        ];
    }
}
