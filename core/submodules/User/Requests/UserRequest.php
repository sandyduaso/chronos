<?php

namespace User\Requests;

use Pluma\Requests\FormRequest;
use User\Models\User;
use User\Repositories\UserRepository;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return true;
        if ($this->user()->isRoot() || $this->user()->id === $this->user) {
            return true;
        }

        switch ($this->method()) {
            case 'POST':
                return $this->user()->can('store-user');
                break;

            case 'PUT':
                return $this->user()->can('update-user');
                break;

            case 'DELETE':
                return $this->user()->can('destroy-user');
                break;

            default:
                return false;
                break;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return UserRepository::bind($this->user)->rules();
    }

    /**
     * The array of override messages to use.
     *
     * @return array
     */
    public function messages()
    {
        return UserRepository::messages();
    }
}
