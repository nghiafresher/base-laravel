<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email,'.$this->user->id,
            'password' => 'required_with:re_password|same:re_password',
            're_password' => 'required_with:password|same:password',
            'phone' => ['nullable', 'max:20', 'regex:/^(0)[0-9]{9}$/'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ và tên là bắt buộc',
            'name.max' => 'Họ và tên tối đa 255 kí tự',
            'email.required' => 'Email là bắt buộc',
            'email.max' => 'Email tối đa 255 kí tự',
            'email.unique' => 'Email đã tồn tại trên hệ thống',
            'email.email' => 'Email chưa đúng định dạng',
            'password.required' => 'Mật khẩu là bắt buộc',
            'password.required_with' => 'Mật khẩu và mật khẩu nhập lại không khớp',
            'password.same' => 'Mật khẩu và mật khẩu nhập lại không khớp',
            're_password.required' => 'Mật khẩu nhập lại là bắt buộc',
            're_password.required_with' => 'Mật khẩu và mật khẩu nhập lại không khớp',
            're_password.same' => 'Mật khẩu và mật khẩu nhập lại không khớp',
            'phone.max' => 'Số điện thoại chưa đúng định dạng',
            'phone.regex' => 'Số điện thoại chưa đúng định dạng',
        ];
    }
}
