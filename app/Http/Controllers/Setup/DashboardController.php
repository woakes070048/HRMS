<?php

namespace App\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct(){
        $this->middleware('auth:setup');
    }


    public function index(){
    	return view('setup.dashboard');
    }
}
