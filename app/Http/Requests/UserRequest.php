<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
        switch (basename(parse_url(url()->previous(), PHP_URL_PATH))) {
            case 'edit':
                return [
                    // 'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
                    'introduction' => 'max:80',
                    'github'       => 'max:30',
                    'weibo'        => 'max:30',
                ];
                break;
            case 'edit_avatar':
                return [
                    'avatar' => 'required|mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
                ];
                break;
            case 'edit_password':
                return [
                    'password' => 'required|string|min:6|confirmed',
                ];
                break;
        }

    }
}
