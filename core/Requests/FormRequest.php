<?php

namespace Pluma\Requests;

use Pluma\Support\Request\FormRequest as BaseRequest;

class FormRequest extends BaseRequest
{
    /**
     * The name of the authorization action.
     *
     * @var string
     */
    protected $name;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->isSuperAdmin() || $this->isAuthorized();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function forbiddenResponse()
    {
        return response()->view('Theme::errors.403', [
            'error' => [
                'code' => 'NOT_AUTHORIZED',
                'message' => 'Unauthorized.',
                'description' => '',
            ]
        ]);
    }

    /**
     * Check if the action is authorized.
     *
     * @return boolean
     */
    public function isAuthorized()
    {
        $name = $this->name;

        switch ($this->method()) {
            case 'POST':
                return $this->user()->can("store-$name");

            case 'PUT':
                return $this->user()->can("update-$name");

            case 'PATCH':
                return $this->user()->can("restore-$name");

            case 'DELETE':
                return $this->user()->can("destroy-$name")
                    || $this->user()->can("delete-$name");

            default:
            case 'GET':
                $name = $this->pluralname ?? str_plural($name);
                return $this->user()->can("view-$name")
                    || $this->user()->can("trashed-$name");
        }

        return false;
    }
}
