<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'tags'        => 'array',  // ← fix: pakai string 'array' bukan AsArray::class
        'tech_stack'  => 'array',
        'features'    => 'array',
        'is_featured' => 'boolean',
        'is_active'   => 'boolean',
    ];
}
