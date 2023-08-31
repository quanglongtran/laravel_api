<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostThread extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $fillable = [
        'name',
        'description',
        'post_category_id',
        'deleted_at',
    ];

    protected function getFilters()
    {
        return [
            new \App\Models\Filters\RelativeFilter('name', $this->filters),
        ];
    }

    public function category()
    {
        return $this->belongsTo(PostCategory::class, 'post_category_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
