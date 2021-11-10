<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class CategoriesController extends Controller
{
    public function getAllCategories()
    {
       
        $categories = DB::table("categories")
             ->select('categories.*');
        $categories = $categories->orderBy("categories.categories_id", "Desc");

        $categories = $categories->paginate(15);
        return view('backend.layouts.Categories.AllCategories')->with('categories', $categories);
    }
    public function AddCategories(Request $request)
    {
       
        return view('backend.layouts.Categories.addCategories');
    }
    public function getSaveCategories(Request $request)
    {
       
        $data = array();
        $data['categories_name'] = $request->name;
        DB::table('categories')->insert($data);
        
        return Redirect::to('/categories')->with([ "message" => "Thêm thành công!"]);;
    }
    public function EditCategories($id)
    {
        
        $id = substr($id,9);
        $categories =  DB::table("categories")->where('categories_id', $id)->get();
        return view('backend.layouts.Categories.editCategories')->with('categories', $categories);
    }
    public function UpdateCategories(Request $request, $id)
    {
        $data = array();
        $data['categories_name'] = $request->name;
        DB::table('categories')->where('categories_id', $id)->update($data);
        
        return Redirect::to('/categories')->with(["message" => "Cập Nhập thành công!"]);
    }
    public function DeleteCategories($id)
    {
        $key = substr($id,0,9);
        $id = substr($id,9);
        DB::table('categories')->where('categories_id', $id)->delete();
        return Redirect::to('/categories')->with([ "message" => "Delete thành công!"]);
    }
}
