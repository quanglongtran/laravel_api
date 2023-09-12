<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Permission;
use Artisan;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timestampsAndGuard = [
            'guard_name' => 'api',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        $crudPermissions = [
            'role',
            'permission',
            'post category',
            'post thread',
            'post',
            'user',
        ];

        $permissions = [
            // other permisisons here
            'decentralization',
        ];

        $dataPermission = collect($crudPermissions)->map(
            fn ($permission) => ["insert $permission", "read $permission", "update $permission", "soft delete $permission", "force delete $permission"]
        )
            ->flatten()
            ->merge($permissions)
            ->map(fn ($permission) => ['name' => $permission, ...$timestampsAndGuard])
            ->toArray();

        DB::table((new Permission())->getTable())->insert($dataPermission);
        Artisan::call('permission:cache-reset');
    }
}
