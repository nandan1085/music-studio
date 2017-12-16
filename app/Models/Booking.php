<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table  = 'bookings';

    protected $guarded = ['id'];

    protected $primaryKey = 'id';

    public function studio(){
        return $this->belongsTo(Studio::class, 'studio_id', 'id');
    }
}
