<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cms extends Model
{
    use HasFactory;

    protected $table = 'cms';

    protected $fillable = [
        'product_id',
        'section_name',
        'section_title',
        'section_description',
        'section_order',
        'status',
        'background_image', 
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
