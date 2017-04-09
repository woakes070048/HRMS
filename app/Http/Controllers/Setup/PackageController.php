<?php

namespace App\Http\Controllers\Setup;

use App\Models\Setup\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class PackageController extends Controller
{
    public function __construct(){
        $this->middleware('auth:setup');
    }

    public function index(){

    	$data['title'] = "Setup|Packages";
    	$data['packages'] = "";

        return view('setup.package.view', $data);
    }

    public function add(){

    	$data['title'] = "Setup|Package Add";
    	$data['permissions'] = Menu::with('child_menu')->where('menu_parent_id', 0)->get();
    	//previout OLD data
		    	$data['info'] = "";
		        $data['salary_info'] = "";
		        $data['parents'] = "";
        //=====OLD DATA==========

        return view('setup.package.add', $data);
    }
}
