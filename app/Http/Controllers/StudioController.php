<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingCreate;
use App\Repositories\StudioRepository;
use App\Service\BookingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class StudioController extends Controller
{
    private $studioRepo;

    public function __construct(StudioRepository $studioRepository)
    {
        $this->studioRepo = $studioRepository;
    }

    public function index(){
        $studios = $this->studioRepo->getStudiosForWelcome();
        return view('welcome', compact('studios'));
    }

    public function search(Request $request){
        return response($this->studioRepo->getSearchData($request->string));
    }

    public function show($url){
        $studio = $this->studioRepo->getStudioByUrl($url);
        abort_if(empty($studio), 404);
        $slots  = $this->studioRepo->getStudioSlots($studio->opening_time, $studio->closing_time);
        return view('details', compact('studio', 'slots'));
    }

    public function book(BookingCreate $request){
        $bookingService = App::make(BookingService::class);
        $booking = $bookingService->store($request);
        return redirect()->route('studio.booking.success')->with(compact('booking'));
    }

    public function success(){
        return view('success');
    }
}
