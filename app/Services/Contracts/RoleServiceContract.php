<?php

namespace App\Services\Contracts;

interface RoleServiceContract extends BaseServiceContract
{
    /**
     * bla bla
     * @param int $id
     * @param array $permissionIds
     */
    public function givePermissionTo($id, $permissionIds);

    /**
     * bla bla
     * @param int $id
     * @param array $permissionIds
     */
    public function syncPermissions($id, $permissionIds);

    /**
     * bla bla
     * @param int $id
     * @param array $permissionIds
     */
    public function revokePermissionTo($id, $permissionIds);
}
