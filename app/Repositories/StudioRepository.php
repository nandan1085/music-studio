<?php

namespace App\Repositories;

use App\Models\Studio;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class StudioRepository
{

    public function getStudiosForWelcome(){
        $studios = new \stdClass();
        $studios->mornings = $this->getMorningStudio();
        $studios->noons    = $this->getAfterNoonStudio();
        $studios->evenings = $this->getEveningStudio();
        $studios->nights   = $this->getNightStudio();
        return $studios;
    }

    public function getStudios($per_page = 18){
        return Studio::paginate($per_page);
    }

    public function getMorningStudio($paginate = false, $perPage = 10){
        $startTime = Carbon::createFromTime('05', '00', '00')->setTimezone('Asia/Kolkata')->toTimeString();
        $query = Studio::where([['opening_time', '<=', $startTime], ['closing_time', '>=', $startTime]]);
        return $paginate ? $query->paginate($perPage) : $query->take(3)->get();
    }

    public function getAfterNoonStudio($paginate = false, $perPage = 10){
        $startTime = Carbon::createFromTime('12', '00', '00')->setTimezone('Asia/Kolkata')->toTimeString();
        $query = Studio::where([['opening_time', '<=', $startTime], ['closing_time', '>=', $startTime]]);
        return $paginate ? $query->paginate($perPage) : $query->take(3)->get();
    }

    public function getEveningStudio($paginate = false, $perPage = 10){
        $startTime = Carbon::createFromTime('17', '00', '00')->setTimezone('Asia/Kolkata')->toTimeString();
        $query = Studio::where([['opening_time', '<=', $startTime], ['closing_time', '>=', $startTime]]);
        return $paginate ? $query->paginate($perPage) : $query->take(3)->get();
    }

    public function getNightStudio($paginate = false, $perPage = 10){
        $startTime = Carbon::createFromTime('21', '00', '00')->setTimezone('Asia/Kolkata')->toTimeString();
        $query = Studio::where([['opening_time', '<=', $startTime], ['closing_time', '>=', $startTime]]);
        return $paginate ? $query->paginate($perPage) : $query->take(3)->get();
    }

    public function getSearchData($string){
        return Studio::where('name', 'like', "%$string%")->take(5)->get(['name', 'action_url']);
    }

    public function getStudioByUrl($url){
        return Studio::where('action_url', $url)->first();
    }

    public function getStudioSlots($opening_time, $closing_time, $studio_id){
        $now = Carbon::now()->setTimezone('Asia/Kolkata');
        $current = Carbon::now()->setTimezone('Asia/Kolkata');
        $current->setTimeFromTimeString($opening_time);
        $start = Carbon::now()->setTimezone('Asia/Kolkata');
        $start->setTimeFromTimeString($opening_time);
        $end = Carbon::now()->setTimezone('Asia/Kolkata');
        $end->setTimeFromTimeString($closing_time);
        $slots = [];
        $bookingRepo = App::make(BookingRepository::class);
        $bookings = $bookingRepo->getBookingsForToday($studio_id);
        $bookedSlots = array_column($bookings->toArray(), 'time');
        while (strtotime($start) <= strtotime($current) && strtotime($current) <= strtotime($end)){
            if(strtotime($now) < strtotime($current)){
                $thisSlot = date('h:i A', strtotime($current));
                if(!in_array($thisSlot, $bookedSlots)){
                    $slots[] = $thisSlot;
                }
            }
            $current->addHour(); // Assuming 1 hour slot
        }
        return $slots;
    }


}