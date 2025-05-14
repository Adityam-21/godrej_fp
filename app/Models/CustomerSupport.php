<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerSupport extends Model
{

      protected $table = 'customer_supports';

     protected $fillable = [
        'icon',
        'title',
        'text',
        'link',
        'status',
    ];
}
