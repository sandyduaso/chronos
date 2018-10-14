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
];
