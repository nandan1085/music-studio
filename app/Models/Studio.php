<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{

    protected $table  = 'studios';

    protected $guarded = ['id'];

    protected $primaryKey = 'id';
}
