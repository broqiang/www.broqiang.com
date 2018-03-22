<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TutorialRequest extends FormRequest
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
            'title'       => 'required|string|between:2,20|unique:tutorials',
            'alias'       => 'required|alpha_dash|unique:tutorials',
            'category_id' => 'required|numeric',
            'description' => 'string|between:10,255',
            'sort'        => 'nullable|integer|between:1,200',
        ];

        if ($this->method() === 'PUT') {
            $validate['title'] = 'required|string|between:2,20|unique:tutorials,title,' . $this->tutorial->id;
            $validate['alias'] = 'required|alpha_dash|unique:tutorials,alias,' . $this->tutorial->id;
        }

        return $validate;
    }

    public function messages()
    {
        return [
            'alias.required'   => '别名必须填写',
            'alias.alpha_dash' => '别名只能由 字母、数字、破折号（ - ）以及下划线（ _ ）组成',
            'alias.unique'     => '别名已经存在，请使用其他名称',
            'sort.integer'     => '排序必须是正整数',
            'sort.between'     => '排序必须是 1-200 之间的整数',
        ];
    }
}
