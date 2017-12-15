<?php

namespace App\Service;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingService
{
    public function store(Request $request){
        $booking = new Booking();
        $booking->studio_id = $request->studio;
        $booking->name = $request->name;
        $booking->email = $request->email;
        $booking->mobile = $request->mobile;
        $booking->date = Carbon::now()->toDateString();
        $booking->time = $request->slot;
        $booking->pax = $request->people;
        $booking->save();
        return $booking;
    }
}