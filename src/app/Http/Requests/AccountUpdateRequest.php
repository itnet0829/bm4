<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountUpdateRequest extends FormRequest
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
            "member_limit_id" => "required|prohibited_if:member_limit_id,0",
            "playdue" => "required",
            "license_deadline" => "required_if:playdue,1"
        ];
    }

    public function messages() {
        return [
            'member_limit_id.prohibited_if'   => "制限を選択してください。",
            'playdue.required' => "利用期限の日付設定方法をどちらかに選んでください。",
            'num_due.required_if' => "数値を入力してください。",
            'license_deadline.required_if' => "日付を入力してください。"
        ];
    }
}
