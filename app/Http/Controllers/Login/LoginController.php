<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;

//use Illuminate\Http\Request;
//use App\Http\Requests;
use DB;
use Request;

class LoginController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('login.login');
    }
    public function doLogin()
    {
        return redirect()->route('tonkho.index');
    }

}
