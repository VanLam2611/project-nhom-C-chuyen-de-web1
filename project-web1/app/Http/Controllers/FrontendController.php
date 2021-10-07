<?php

namespace App\Http\Controllers;

use Facade\FlareClient\View;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function getIndex()
    {
        $test =" Hello";
        return View('Frontend.index-master')->with('test',$test);
    } 
}
