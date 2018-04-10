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
            'category_id' => 'required|numeric',
            'slug'  => [
                'required',
                'between:4,200',
                'regex:/^[a-zA-Z0-9_-]+$/u',
            ],
            'description' => 'string|between:10,255',
            'sort'        => 'nullable|integer|between:1,200',
        ];

        if ($this->method() === 'PUT') {
            $validate['title'] = 'required|string|between:2,20|unique:tutorials,title,' . $this->tutorial->id;
        }

        return $validate;
    }

    public function messages()
    {
        return [
            'sort.integer'     => '排序必须是正整数',
            'sort.between'     => '排序必须是 1-200 之间的整数',
        ];
    }
}
