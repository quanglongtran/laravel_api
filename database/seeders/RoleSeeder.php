<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Role;

class RoleSeeder extends Seeder
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

        $roles = [
            'super admin',
            'manager',
            'member',
            'guest',
        ];

        DB::table((new Role)->getTable())->insert(array_map(fn ($role) => ['name' => $role, ...$timestampsAndGuard], $roles));
        User::find(1)->assignRole('super admin');
    }
}
