<?php

namespace Pluma\Requests;

use Pluma\Support\Request\FormRequest as BaseRequest;

class FormRequest extends BaseRequest
{
    protected $name;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if ($this->user()->isRoot() || $this->user()->id === $this->user) {
            return true;
        }

        switch ($this->method()) {
            case 'POST':
                return $this->user()->can("store-{$this->name}");
                break;

            case 'PUT':
                return $this->user()->can("update-{$this->name}");
                break;

            case 'DELETE':
                return $this->user()->can("destroy-{$this->name}");
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
}
