<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClausesModel extends Model
{
    protected $table = 'clauses';

    protected $fillable = [
        'title',
        'content'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];
}
