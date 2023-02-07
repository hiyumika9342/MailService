<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailStoreRequest extends FormRequest
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
            'email_address' => 'required|email|max:100'
        ];
    }

    /**
     * @return string[]
     */
    public function messages() {
        return [
            'email_address.required' => 'メールアドレスを入力してください。',
            'email_address.email'  => 'メールアドレスとして正しい形式ではありません。',
            'email_address.max:100'  => 'メールアドレスは100文字以内で登録してください。',
        ];
    }
}
