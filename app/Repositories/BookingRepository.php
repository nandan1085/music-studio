<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Support\Carbon;

class BookingRepository
{

    public function getBookingsForToday($studio_id){
        $today = Carbon::now()->setTimezone('Asia/Kolkata')->toDateString();
        return Booking::where([['studio_id', '=', $studio_id], ['date', '=', $today]])->get(['time']);
    }
}