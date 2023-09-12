<?php

namespace App\Services\Contracts;

interface RoleServiceContract extends BaseServiceContract
{
    /**
     * bla bla
     * @param int|\App\Models\Role $role
     * @param string[] $permissionNames
     * @return \App\Models\Role
     */
    public function givePermissionTo($model, $permissionNames);

    /**
     * bla bla
     * @param int|\App\Models\Role $role
     * @param string[] $permissionNames
     * @return \App\Models\Role
     */
    public function syncPermissions($role, $permissionNames);

    /**
     * bla bla
     * @param int|\App\Models\Role $role
     * @param string[] $permissionNames
     * @return \App\Models\Role
     */
    public function revokePermissionTo($role, $permissionNames);
}
