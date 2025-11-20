<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_name',
        'description',
        'client_name',
        'location',
        'completion_date',
        'images',
        'category',
        'is_featured',
    ];

    protected $casts = [
        'completion_date' => 'date',
        'images' => 'array',
        'is_featured' => 'boolean',
    ];
}