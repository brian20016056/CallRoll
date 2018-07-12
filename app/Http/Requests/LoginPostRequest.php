<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'username' => 'required|string',
			'password' => 'required|string'
        ];
    }
	
	public function messages()
	{
		return [
			'required' => '會員帳號或密碼必須填寫',
			'string' => '會員帳號或密碼必須為英數字元'
		];
	}
}
