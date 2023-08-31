<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    use HasFactory;

    public function scopeFilter(Builder $query, $request)
    {
        $criteria = $this->filterCriteria();
        return app(\Illuminate\Pipeline\Pipeline::class)
            ->send($query, $request)
            ->through($criteria)
            ->thenReturn();
    }

    public function filterCriteria(): array
    {
        return [];
    }
}
