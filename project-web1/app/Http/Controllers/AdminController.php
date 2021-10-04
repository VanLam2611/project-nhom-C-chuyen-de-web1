<?php

namespace App\Http\Controllers;

use App\Bill;
use App\Bill_Detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\UploadedFile;
use App\shipping;
use App\Product;
use App\User;
use Illuminate\Support\Facades\App;

use function Livewire\str;

class AdminController extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session::get('id');

        $admin_role = Session::get('role');

        if ($admin_id) {
            if ($admin_role == '1') {
                $admin_name = DB::table('users')->where('id', $admin_id)->first();
                return Redirect::to('/admin/tc')->with(compact('admin_name'));
            } else {
                return Redirect::to('/')->send();
            }
        } else {
            return Redirect::to('/logout-checkout')->send();
        }
    }
    public function getNameAdmin()
    {
        $admin_id = Session::get('id');
        $admin_name = DB::table('users')->where('id', $admin_id)->first();
    }
    public function getIndexAdmin()
    {
       
        return view('backend.layouts.index');
    }
    public function LogoutAdmin()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function getAllHotel()
    {
      
        $all_hotel = DB::table("hotel")
            // ->join('protypes', 'protypes.id', '=', 'products.type_id')
            // ->join('manufactures', 'manufactures.id', '=', 'products.manu_id')
             ->select('hotel.*');
        $all_hotel = $all_hotel->orderBy("hotel.id", "Desc");

        $all_hotel = $all_hotel->paginate(15);
        return view('backend.layouts.Hotel.AllHotels')->with('all_hotel', $all_hotel);
    }
    public function AddHotel(Request $request)
    {
       
        return view('backend.layouts.Hotel.addHotel');
    }
    public function getSaveHotel(Request $request)
    {
    
        $data = array();
        $data['name'] = $request->name;
        $data['status'] = 0;
       
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('img/hotel/', $new_image);
            $data['image'] = $new_image;
            DB::table('hotel')->insert($data);
          
            return Redirect::to('/hotels')->with([ "message" => "Thêm thành công!"]);;
        }
        $data['image'] = '';
        DB::table('hotel')->insert($data);
        
        return Redirect::to('/hotels')->with([ "message" => "Thêm thành công!"]);;
    }
    public function EditHotel($id)
    {
        
        $id = substr($id,9);
        $edit_hotel =  DB::table("hotel")->where('id', $id)->get();
        return view('backend.layouts.Hotel.editHotel')->with('edit_hotel', $edit_hotel);
    }
    public function UpdateHotel(Request $request, $id)
    {
       
        $data = array();
        $data['name'] = $request->name;
        $data['status'] = 0;
      
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name));
            $new_image = $name_image . rand(0, 99) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('img/hotel/', $new_image);
            $data['image'] = $new_image;
            DB::table('hotel')->where('id', $id)->update($data);
          
            return Redirect::to('/hotels')->with([ "message" => "Cập Nhập thành công!"]);
        }
        
        DB::table('hotel')->where('id', $id)->update($data);
        
        return Redirect::to('/hotels')->with(["message" => "Cập Nhập thành công!"]);
    }
    public function DeleteHotel($id)
    {
        // $this->AuthLogin();
        // $admin_id = Session::get('id');
        // $admin_name = DB::table('users')->where('id', $admin_id)->first();
        $key = substr($id,0,9);
        $id = substr($id,9);
        
        DB::table('hotel')->where('id', $id)->delete();

        
        return Redirect::to('/hotels')->with([ "message" => "Delete thành công!"]);
    }
   
}
