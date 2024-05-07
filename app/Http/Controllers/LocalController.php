<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalController extends Controller
{

    public function setLocale($lang){
        Session::put('lang',$lang);
        return redirect('/');
    }
    //
}

