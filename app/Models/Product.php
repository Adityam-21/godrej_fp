<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'category',
        'subcategory',
        'pdf_title',
        'video_title',
        'video_link',
        'page_slug',
        'status',
        'description',
    ];

    public function manuals()
    {
        return $this->hasMany(\App\Models\UserManual::class, 'product_id');
    }
    public function videos()
    {
        return $this->hasMany(\App\Models\Video::class, 'product_id');
    }
}
