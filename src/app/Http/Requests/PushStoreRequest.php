<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PushStoreRequest extends FormRequest
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
            "check-group" => "required_if:sender,1", 
            "check-user" => "required_if:sender,2", 
            "subjects" => "required",
            "message" => "required",
            "start_broadcasting_time" => "required"
        ];
    }

    public function messages() {
        return [
            'check-user.required_if' => "送信するユーザーを最低1人選んでください。",
            'check-group.required_if' => "送信するユーザーを最低1人選んでください。",
            'subjects.required' => "タイトルを入力してください。",
            'message.required' => "メッセージを入力してください。",
            'start_broadcasting_time.required' => "配信開始日付を入力してください。"
        ];
    }
}
