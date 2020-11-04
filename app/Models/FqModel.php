<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FqModel extends Model
{
    protected $table = 'fq';

    protected $fillable = [
        'title',
        'order_no',
        'content'
    ];
}
