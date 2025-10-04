<?php
namespace App\Http\Requests\Rust;

use Illuminate\Foundation\Http\FormRequest;

class TreasureRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'user_code' => ['required', 'string', 'max:255', 'exists:rust_users,code'],
            'code' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages() {
        return [
            'user_code.required' => 'لطفا رمز خود را وارد کنید.',
            'user_code.exists' => 'رمز وارد شده معتبر نیست.',
            'code.required' => 'لطفا کد گنجینه را وارد کنید.',
            'code.exists' => 'کد گنجینه وارد شده معتبر نیست.',
        ];
    }
}
