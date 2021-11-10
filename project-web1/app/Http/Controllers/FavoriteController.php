<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class FavoriteController extends Controller
{
    public function getAllFavorite()
    {
      
        $favorite = DB::table("favorite")
             ->join('hotel', 'hotel.hotel_id', '=', 'favorite.hotel_id')
         
             ->select('favorite.*','hotel.name');
        $favorite = $favorite->orderBy("favorite.favorite_id", "Desc");

        $favorite = $favorite->paginate(15);
        return view('backend.layouts.Favorite.AllFavorite')->with('favorite', $favorite);
    }
   
    public function DeleteFavorite($id)
    {
       
        $key = substr($id,0,9);
        $id = substr($id,9);
        
        DB::table('favorite')->where('favorite_id', $id)->delete();

        
        return Redirect::to('/favorite')->with([ "message" => "Delete thành công!"]);
    }
}
