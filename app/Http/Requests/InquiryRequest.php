<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InquiryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'inquiry/userform') {
            return true;
        }
        else{
            return false;
        }
       
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'usersupport' => 'required',
            'userdetail' => 'required|string|max:1000',
            'username' => 'required|string|max:150',
            'usertel' => 'required|numeric|digits_between:10,11',
            'useremail1' => 'required|email',
            'useremail2' => 'required|email|same:useremail1'
        ];
    }

    /**
     * エラーメッセージのカスタマイズ
     */
    public function messages()
    {
        return [
            'usersupport.required' => 'サポート内容を選択してください。', 
            'userdetail.required' => '具体的な内容は必ず入力してください。',
            'userdetail.max' => '具体的な内容は1000文字以内で入力してください。',
            'username.required' => 'お名前は必ず入力してください。',
            'username.max' => 'お名前は150文字以内で入力してください。',
            'usertel.required' => '電話番号は必ず入力してください。',
            'usertel.numeric' => '電話番号はハイフンなしで数字のみ入力してください。',
            'usertel.digits_between' => '電話番号は10桁もしくは11桁で入力してください',
            'useremail1.required' => 'メールアドレスは必ず入力してください。',
            'useremail1.email' => 'メールアドレスの形式で入力してください。',
            'useremail2.required' => '確認用メールアドレスは必ず入力してください。',
            'useremail2.email' => 'メールアドレスの形式で入力してください。',
            'useremail2.same' => 'メールアドレスが不一致です。'
        ];
    }
}
