<?php

namespace User\Requests;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Pluma\Requests\FormRequest;

class PasswordTokenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $reset = DB::table(config('auth.passwords.users.table', 'password_resets'))
            ->where('email', $this->email)
            ->first();

        if (! $reset || ! Hash::check($this->token, $reset->token)) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [];
    }
}
