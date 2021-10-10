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

        return View('Frontend.layout.index');
    } 
    public function getAllHotel()
    {
        $all_hotel = DB::table('hotel')
        ->join('location','location.location_id','=','hotel.location')
        ->select('hotel.*','location.*');
       
        $all_hotel = $all_hotel->orderBy("hotel.hotel_id","DESC");
        $all_hotel = $all_hotel->paginate(15);

        // $rating_number = $this->getRatingHotelId();
        
        return View('Frontend.layout.hotel.all-hotel')->with('all_hotel',$all_hotel);
    } 
    public function getDetailHotel($id)
    {
        $all_hotel = DB::table('hotel')
        ->join('location','location.location_id','=','hotel.location')
        ->where('hotel.hotel_id',$id)
        ->get();
        $rating_number = $this->getRatingHotelId($id);
        return View('Frontend.layout.hotel.detail',compact('all_hotel','rating_number'));
    } 
    public function getRatingHotelId($id)
    {
        $total_rating = 0; 
       
        $rating = DB::table('hotel')
        ->join('rating','rating.hotel_id','=','hotel.hotel_id')
        ->where('hotel.hotel_id',$id)->get();
        $count = $rating->count();
        foreach($rating as $value)
        {
            $total_rating += $value->number_rating;

        }
        $rating_hotel = ceil($total_rating/$count);
        return $rating_hotel;

        return view('frontend.layout.index');
    } 

    /**
     * Show hotel in option -- Home --
     */
    public function rentalHotelOption(Request $request){
        $hotel =  DB::table('hotel')->where('person', $request->person)->get();
        return view('frontend.layout.details')->with('hotel_search', $hotel);

    }
    function postSearchAjax(Request $request)
    {
        if ($request->get('query')) {
            $query = $request->get('query');
            $data = DB::table('hotel')
                ->where('name', 'LIKE', "%{$query}%")->orWhere('hotel_info', 'LIKE', "%{$query}%")
                ->get();
            // $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
            foreach ($data as $row) {
                $output = '
                <option value="'.$row->name.'">'.$row->hotel_info.'</option>';
            }
            echo $output;
        }
    }
    public function getAllHotelSearch(Request $request)
    {
        $query = "";
         if ($request->has('query')) {
            $query = $request->query;
        }
        
        $all_hotel = DB::table('hotel')
        
        ->where('name', 'LIKE',  '%'.$query.'%') ->get();
        return View('Frontend.layout.hotel.all-hotel-search')->with('all_hotel',$all_hotel);
    } 
}
