<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "name" => "required|string",
            "email" => "required|string|unique:bm_users",
            "telephone_number" => "required",
            "encrypted_password" => "required",
            "encrypted_password_confirm" => "required|same:encrypted_password",
            "bet365_userid" => "nullable|required_with:bet365_enc_password,''",
            "bet365_enc_password" => "nullable|required_with:bet365_userid,''",
            "group_id" => "nullable",
            "member_limit_id" => "required|prohibited_if:member_limit_id,0",
            "playdue" => "required",
            "num_due" => "required_if:playdue,1",
            "license_deadline" => "required_if:playdue,2"
        ];
    }

    /**
     * エラーメッセージ
     *
     * @return array
     */
    public function messages() {
        return [
            'name.required'   => "名前を入力してください。",
            'email.required'   => "メールアドレスを入力してください。",
            'email.unique' => "このメールアドレスはすでに使われています。",
            'telephone_number.required'   => "電話番号を入力してください。",
            'encrypted_password.required'   => "パスワードを入力してください。",
            'encrypted_password_confirm.required'   => "確認用パスワードを入力してください。",
            'bet365_userid.required_with' => "Bet365のIDが入力されています。パスワードを入力してください。",
            'bet365_enc_password.required_with' => "Bet365のパスワードが入力されています。IDを入力してください。",
            'encrypted_password_confirm.same'   => "パスワードが一致しません。",
            'member_limit_id.prohibited_if'   => "制限を選択してください。",
            'playdue.required' => "利用期限の日付設定方法をどちらかに選んでください。",
            'num_due.required_if' => "数値を入力してください。",
            'license_deadline.required_if' => "日付を入力してください。"
        ];
    }
}
