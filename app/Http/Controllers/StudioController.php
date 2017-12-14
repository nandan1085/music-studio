<?php

namespace App\Http\Controllers;

use App\Repositories\StudioRepository;
use Illuminate\Http\Request;

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
}
