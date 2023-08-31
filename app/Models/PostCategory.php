<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $fillable = [
        'name',
        'description',
    ];

    protected function getFilters()
    {
        return [
            new \App\Models\Filters\RelativeFilter('name', $this->filters),
            new \App\Models\Filters\ExactFilter('id', $this->filters),
        ];
    }

    public function threads()
    {
        return $this->hasMany(PostThread::class);
    }

    public function posts()
    {
        return $this->hasManyThrough(Post::class, PostThread::class);
    }
}
