<?php

namespace User\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'middlename' => $this->middlename,
            'lastname' => $this->lastname,
            'username' => $this->username,
            'email' => $this->email,
            'fullname' => $this->fullname,
            'roles' => $this->roles->pluck('alias', 'code'),
            'photo' => $this->photo,
            'created' => $this->created,
            'api_token' => $this->token,
            'modified' => $this->modified,
        ];
    }
}
