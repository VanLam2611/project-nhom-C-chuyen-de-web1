<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class LocationController extends Controller
{
    public function getAllLocation()
    {
      
        $location = DB::table("location")
             ->select('location.*');
        $location = $location->orderBy("location.location_id", "Desc");

        $location = $location->paginate(15);
        return view('backend.layouts.Location.AllLocation')->with('location', $location);
    }
    public function AddLocation(Request $request)
    {
        return view('backend.layouts.Location.addLocation');
    }
    public function getSaveLocation(Request $request)
    {
      
        $data = array();
        $data['address'] = $request->address;
        DB::table('location')->insert($data);
        
        return Redirect::to('/location')->with([ "message" => "Thêm thành công!"]);;
    }
    public function EditLocation($id)
    {
        $id = substr($id,9);
        $location =  DB::table("location")->where('location_id', $id)->get();
        return view('backend.layouts.Location.editLocation')->with('location', $location);
    }
    public function UpdateLocation(Request $request, $id)
    {
        
        $data = array();
        $data['address'] = $request->address;
       
        
        DB::table('location')->where('location_id', $id)->update($data);
        
        return Redirect::to('/location')->with([ "message" => "Cập Nhập thành công!"]);
    }
    public function DeleteLocation($id)
    {
        $key = substr($id,0,9);
        $id = substr($id,9);
        DB::table('location')->where('location_id', $id)->delete();

        
        return Redirect::to('/location')->with([ "message" => "Delete thành công!"]);
    }
}
