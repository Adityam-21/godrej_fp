<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
     protected $fillable = [
        'products_id',
        'title',
        'video_url',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
