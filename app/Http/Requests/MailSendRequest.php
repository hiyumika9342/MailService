<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailSendRequest extends FormRequest
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
            'mail_send_ids' => 'required',
            'mail_send_message' => 'required'
        ];
    }

    /**
     * @return string[]
     */
    public function messages() {
        return [
            'mail_send_ids.required' => 'メールの宛先を選択してください。',
            'mail_send_message.required'  => 'メッセージを入力してください。'
        ];
    }
}
