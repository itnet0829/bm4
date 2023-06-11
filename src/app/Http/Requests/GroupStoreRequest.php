<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupStoreRequest extends FormRequest
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
            'group_name' => "required",
            'administrator_name' => "required"
        ];
    }

    public function messages() {
        return [
            'group_name.required' => "グループ名を入力してください。",
            'administrator_name.required' => "管理者名を入力してください。"
        ];
    }
}
