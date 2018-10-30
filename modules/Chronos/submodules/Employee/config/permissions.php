<?php
/**
 *------------------------------------------------------------------------------
 * Permissions Array
 *------------------------------------------------------------------------------
 *
 * Here we define our permissions that you can attach to roles.
 *
 * These permissions corresponds to a counterpart
 * route (found in <this module>/routes/<route-files>.php).
 * All permissionable routes should have a `name` (e.g. 'roles.store')
 * for the role authentication middleware to work.
 *
 */
return [
    /**
     *--------------------------------------------------------------------------
     * $name Permissions
     *--------------------------------------------------------------------------
     *
     */
    'view-employees' => [
        'name' =>  'view-employees',
        'code' => 'employees.index',
        'description' => 'Ability to view list of employees',
        'group' => 'employee',
    ],
    'show-employee' => [
        'name' => 'show-employee',
        'code' => 'employees.show',
        'description' => 'Ability to show a single employee',
        'group' => 'employee',
    ],
    'edit-employee' => [
        'name' => 'edit-employee',
        'code' => 'employees.edit',
        'description' => 'Ability to view the edit form',
        'group' => 'employee',
    ],
    'create-employee' => [
        'name' => 'create-employee',
        'code' => 'employees.create',
        'description' => 'Ability to create new employee',
        'group' => 'employee',
    ],
    'store-employee' => [
        'name' => 'store-employee',
        'code' => 'employees.store',
        'description' => 'Ability to save the employee',
        'group' => 'employee',
    ],
    'update-employee' => [
        'name' => 'update-employee',
        'code' => 'employees.update',
        'description' => 'Ability to update the employee',
        'group' => 'employee',
    ],
    'destroy-employee' => [
        'name' => 'destroy-employee',
        'code' =>  'employees.destroy',
        'description' => 'Ability to move the employee to trash',
        'group' => 'employee',
    ],
    'delete-employee' => [
        'name' => 'delete-employee',
        'code' =>  'employees.delete',
        'description' => 'Ability to permanently delete the employee',
        'group' => 'employee',
    ],
    'trashed-employees' => [
        'name' => 'trashed-employees',
        'code' =>  'employees.trashed',
        'description' => 'Ability to view the list of all trashed employees',
        'group' => 'employee',
    ],
    'restore-employee' => [
        'name' => 'restore-employee',
        'code' => 'employees.restore',
        'description' => 'Ability to restore the employee from trash',
        'group' => 'employee',
    ],

    /**
     *--------------------------------------------------------------------------
     * Limited Access Policies
     *--------------------------------------------------------------------------
     * The policy stated below will limit the users to only interact with
     * resources they created. Using this policy, the resource will usually have
     * a `user_id` field defined. A Policy Class is also required to check
     * authorization.
     *
     * E.g.
     *  1. User1 will only be able to edit/delete their own created pages.
     *  2. User1 will not be able to edit User2's created pages.
     *  3. User1 will not be able to delete User2's created pages.
     *  4. User1 will be able to view other users created pages. Although this can
     *     be set to be otherwise. It will depend on the Policy file.
     */
    'unrestricted-employee-access' => [
        'name' => 'unrestricted-employee-access',
        'code' => 'employees.unrestricted',
        'description' => 'Ability to edit and delete all employees even if the user is not the creator of the employee.',
        'group' => 'employee',
    ],
];
