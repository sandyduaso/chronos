<?php

namespace User\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Validation\Rule;
use Pluma\Support\Repository\Repository;
use Role\Models\Role;
use User\Models\User;

class UserRepository extends Repository
{
    /**
     * The model instance.
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model = User::class;

    /**
     * Set of rules the model should be validated against when
     * storing or updating a resource.
     *
     * @return array
     */
    public static function rules()
    {
        return [
            'firstname' => 'required|max:255',
            'lastname' => 'required|max:255',
            'password' => 'sometimes|required|min:6|confirmed',
            'username' => [
                'required',
                Rule::unique('users')->ignore(self::$id),
            ],
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore(self::$id),
            ],
        ];
    }

    /**
     * Array of custom error messages upon validation.
     *
     * @return array
     */
    public static function messages()
    {
        return [
            'roles.required' => 'Atleast one role is required.',
        ];
    }

    /**
     * Retrieve the roles list.
     *
     * @return array
     */
    public function roles()
    {
        return Role::all();
    }

    /**
     * Create model resource.
     *
     * @param array $data
     */
    public function create(array $data)
    {
        $user = new User();
        $user->prefixname = $data['prefixname'] ?? null;
        $user->firstname = $data['firstname'] ?? null;
        $user->middlename = $data['middlename'] ?? null;
        $user->lastname = $data['lastname'] ?? null;
        $user->username = $data['username'] ?? null;
        $user->email = $data['email'] ?? null;
        $user->password = bcrypt($data['password']) ?? null;
        $user->avatar = $data['avatar'] ?? null;
        $user->tokenize($data['username']) ?? null;
        $user->save();
        $user->roles()->attach(! empty($data['roles']) ? $data['roles'] : []);

        if (isset($data['details'])) {
            // dd($data['details']);
            collect($data['details'])->each(function ($detail) use ($user) {
                $user->details()->create([
                    'icon' => $detail['icon'],
                    'key' => $detail['key'],
                    'value' => $detail['value']
                ]);
            });
        }

        return $user;
    }
}
