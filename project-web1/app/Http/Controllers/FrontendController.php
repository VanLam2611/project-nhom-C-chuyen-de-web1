<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FrontendController extends Controller
{
    public function getIndex()
    {
        return view('frontend.layout.index');
    } 

    /**
     * Show hotel in option -- Home --
     */
    public function rentalHotelOption(Request $request){
        $hotel =  DB::table('hotel')->where('person', $request->person)->get();
        return view('frontend.layout.details')->with('hotel_search', $hotel);
    }
}
