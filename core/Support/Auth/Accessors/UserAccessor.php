<?php

namespace Pluma\Support\Auth\Accessors;

use Closure;
use Parchment\Helpers\Word;

trait UserAccessor
{
    /**
     * Array of roles.
     *
     * @var array
     */
    protected $rolenames;

    /**
     * Retrieve the mutated handlename.
     *
     * @return string
     */
    public function getHandlenameAttribute()
    {
        return (isset($this->username) ? $this->username : study_case("$this->firstname $this->lastname"));
    }

    /**
     * Retrieve the mutated array of roles.
     *
     * @return string
     */
    public function getDisplayroleAttribute()
    {
        if ($this->roles()->exists()) {
            foreach ($this->roles as $role) {
                $this->rolenames[$role->name] = $role->name;
            }
        } else {
            return __('Guest');
        }

        return implode(" / ", $this->rolenames);
    }

    /**
     * Retrive the mutated firstname, middlename, lastname role.
     *
     * @return string
     */
    public function getFullnameAttribute()
    {
        $name = [];
        $this->prefixname ? $name[] = $this->prefixname : '';
        $this->firstname ? $name[] = $this->firstname : '';
        $name[] = $this->lastname;
        $name = trim(implode(" ", $name));

        return ! empty($name) ? $name : $this->username;
    }

    /**
     * Retrieve the mutated lastname, firstname.
     *
     * @return string
     */
    public function getPropernameAttribute()
    {
        $name[] = $this->lastname ? "$this->lastname, " : '';
        $name[] = $this->firstname;
        $name = trim(implode(" ", $name));

        return $name ?? $this->username;
    }

    /**
     * Retrieve the mutated display name.
     *
     * @return string
     */
    public function getDisplaynameAttribute()
    {
        $displayname = $this->detail('display_name', settings('display_name', "%firstname% %middleinitial% %lastname%"));
        $displayname = preg_replace('/%firstname%/', $this->firstname, $displayname);
        $displayname = preg_replace('/%lastname%/', $this->lastname, $displayname);
        $displayname = preg_replace('/%middlename%/', $this->middlename, $displayname);
        $displayname = preg_replace('/%prefixname%/', $this->firstname, $displayname);
        $displayname = preg_replace('/%middleinitial%/', Word::acronym($this->middlename, $this->middlename ? true : false), $displayname);
        $displayname = preg_replace('/%firstinitial%/', Word::acronym($this->firstname, $this->firstname ? true : false), $displayname);
        $displayname = preg_replace('/%lastinitial%/', Word::acronym($this->lastname, $this->lastname ? true : false), $displayname);
        $displayname = preg_replace('/%fullname%/', $this->fullname, $displayname);

        return ! empty(trim($displayname))
               ? $displayname
               : $this->username;
    }

    /**
     * Gets the mutated bio of the resource.
     *
     * @return string
     */
    public function getBioAttribute()
    {
        $placeholder = $this->id == user()->id ? __("A short description about yourself will look nice here.") : __("The user haven't shared thier bio yet.");
        return $this->detail('bio', $placeholder);
    }

    /**
     * Gets the mutated email of the resource.
     *
     * @return string
     */
    public function getDisplayemailAttribute()
    {
        return ! (bool) $this->detail('
            keep_my_email_private', true)
               ? $this->email
               : 'Private email';
    }

    public function getProfessionAttribute()
    {
        return 'User';
    }
}
