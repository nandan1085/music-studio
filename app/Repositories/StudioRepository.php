<?php

namespace App\Repositories;

use App\Models\Studio;
use Carbon\Carbon;
use Illuminate\Http\Request;

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

    public function getMorningStudio($paginate = false, $perPage = 10){
        $startTime = Carbon::createFromTime('05', '00', '00')->toTimeString();
        $query = Studio::where([['opening_time', '<=', $startTime], ['closing_time', '>=', $startTime]]);
        return $paginate ? $query->paginate($perPage) : $query->take(3)->get();
    }

    public function getAfterNoonStudio($paginate = false, $perPage = 10){
        $startTime = Carbon::createFromTime('12', '00', '00')->toTimeString();
        $query = Studio::where([['opening_time', '<=', $startTime], ['closing_time', '>=', $startTime]]);
        return $paginate ? $query->paginate($perPage) : $query->take(3)->get();
    }

    public function getEveningStudio($paginate = false, $perPage = 10){
        $startTime = Carbon::createFromTime('17', '00', '00')->toTimeString();
        $query = Studio::where([['opening_time', '<=', $startTime], ['closing_time', '>=', $startTime]]);
        return $paginate ? $query->paginate($perPage) : $query->take(3)->get();
    }

    public function getNightStudio($paginate = false, $perPage = 10){
        $startTime = Carbon::createFromTime('21', '00', '00')->toTimeString();
        $query = Studio::where([['opening_time', '<=', $startTime], ['closing_time', '>=', $startTime]]);
        return $paginate ? $query->paginate($perPage) : $query->take(3)->get();
    }

    public function getSearchData($string){
        return Studio::where('name', 'like', "%$string%")->take(5)->get(['name', 'action_url']);
    }

    public function getStudioByUrl($url){
        return Studio::where('action_url', $url)->first();
    }

    public function getStudioSlots($opening_time, $closing_time){
        $now = Carbon::now();
        $current = Carbon::now();
        $current->setTimeFromTimeString($opening_time);
        $start = Carbon::now();
        $start->setTimeFromTimeString($opening_time);
        $end = Carbon::now();
        $end->setTimeFromTimeString($closing_time);
        $slots = [];
        while (strtotime($start) <= strtotime($current) && strtotime($current) <= strtotime($end)){
            if(strtotime($now) < strtotime($current)){
                $slots[] = date('h:i A', strtotime($current));
            }
            $current->addHour(); // Assuming 1 hour slot
        }
        return $slots;
    }


}