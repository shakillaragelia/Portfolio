<?php
// app/Models/Project.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArray;

class Project extends Model
{
    protected $fillable = [
        'title', 'slug', 'description', 'long_description',
        'thumbnail', 'tags', 'tech_stack', 'features',
        'type', 'role', 'duration', 'year',
        'demo_url', 'github_url',
        'is_featured', 'sort_order', 'is_active',
    ];

    protected $casts = [
        'tags'        => AsArray::class,
        'tech_stack'  => AsArray::class,
        'features'    => AsArray::class,
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];
}
