<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as BasePermission;
use App\Models\Role;
use App\Traits\Filterable;

class Permission extends BasePermission implements \Spatie\Permission\Contracts\Permission
{
    use HasEvents, HasFactory, Filterable;

    protected static function boot()
    {
        parent::boot();

        // Once created, it will automatically assign itself to the super admin role.
        static::created(function ($permission) {
            Role::findById(1)->givePermissionTo($permission);
        });
    }

    protected function getFilters()
    {
        return [
            new \App\Models\Filters\RelativeFilter('display_name', $this->filters),
            new \App\Models\Filters\RelativeFilter('name', $this->filters),
            new \App\Models\Filters\ExactFilter('id', $this->filters),
            new \App\Models\Filters\ExactFilter('guard_name', $this->filters),
        ];
    }
}
