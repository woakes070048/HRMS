<?php

namespace App\Http\Controllers\Pim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

use App\Models\Promotion;
use App\Models\User;
use App\Models\Designation;
use App\Models\Level;

class PromotionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hrms');

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            view()->share('auth',$this->auth);
            return $next($request);
        });
    }

    public function index(){

        $val = Designation::find(4);

        $find_same_level_desig = Designation::where('level_id',$val->level_id)->get();
        //var_dump($find_same_level_desig);

        foreach($find_same_level_desig as $info)
        {
            echo $info->designation_name."<br>";
        }

        die();
    	$data['title'] = "Promotions/Transfer";
        return view('pim.promotion', $data);
    }

    public function getPromotionsData(){

        return Promotion::with('user','prev_designation','current_designation','prev_branch','current_branch','prev_unit.promotionDepartment','current_unit.promotionDepartment','prev_supervisor','current_supervisor')->orderBy('id','DESC')->get();
    }

    public function getSingelUser($id){

        return User::with('branch', 'designation.department','designation.level', 'unit')->where('id', $id)->first();
    }
}
