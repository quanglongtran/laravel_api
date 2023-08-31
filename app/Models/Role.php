<?php

namespace App\Models;

use App\Commons\HttpStatusCodes;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as BaseRole;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class Role extends BaseRole implements \Spatie\Permission\Contracts\Role
{
    use HasFactory, HasEvents, Filterable;

    protected static function boot()
    {
        parent::boot();

        static::deleting(function (Role $role) {
            if ($role->id == 1) {
                throw new BadRequestHttpException('This role cannot be deleted', null, HttpStatusCodes::HTTP_FORBIDDEN);
            }
        });
    }

    protected function getFilters()
    {
        return [
            new \App\Models\Filters\RelativeFilter('display_name', $this->filters),
            new \App\Models\Filters\ExactFilter('name', $this->filters),
            new \App\Models\Filters\ExactFilter('id', $this->filters),
            new \App\Models\Filters\ExactFilter('guard_name', $this->filters),
        ];
    }
}
