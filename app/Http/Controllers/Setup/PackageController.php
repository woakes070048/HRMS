<?php

namespace App\Http\Controllers\Setup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PackageController extends Controller
{
    public function __construct(){
        $this->middleware('auth:setup');
    }

    public function index(){

    	$data['title'] = "Setup Packages";
    	// return view('setup.package', $data);
    	return "test packages";
    }
}
