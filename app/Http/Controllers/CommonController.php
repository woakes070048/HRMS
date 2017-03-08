<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CommonService;

class CommonController extends Controller
{
    use CommonService;

    public function __construct(){
    	$this->middleware('auth:hrms');
    }


}
