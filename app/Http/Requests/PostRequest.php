<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title'    => 'required|string|between:5,128',
            'skill_id' => 'required',
            'excerpt'  => 'required|string|between:5,512',
            'body'     => 'required|string|min:5|max:16777215',
        ];
    }

    public function messages()
    {
        return [
            'skill_id.required' => '所属技能必须选择',
        ];
    }
}
