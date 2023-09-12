<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $fillable = [
        'name',
        'content',
        'post_thread_id',
        'user_id',
        'tags',
    ];

    protected function getFilters()
    {
        return [
            new \App\Models\Filters\RelativeFilter('name', $this->filters),
            new \App\Models\Filters\ExactFilter('id', $this->filters),
            new \App\Models\Filters\ExactFilter('post_thread_id', $this->filters),
        ];
    }

    public function thread()
    {
        return $this->belongsTo(PostThread::class, 'post_thread_id');
    }

    public function category()
    {
        return $this->thread()->category();
    }
}
