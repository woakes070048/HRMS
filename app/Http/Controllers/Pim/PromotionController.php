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

    public function findParent($levelId, $parentAry){
            
        $val = Level::where('id',$levelId)->first();

        if($val->parent_id > 0){

            array_push($parentAry, $val->parent_id);
            // echo $val->parent_id." *-*";
            return $this->findParent($val->parent_id, $parentAry);
        }

        return $parentAry;
    }

    public function index(){
        
    	$data['title'] = "Promotions/Transfer";
        return view('pim.promotion', $data);
    }

    public function getPromotionsData(){

        return Promotion::with('user','prev_designation','current_designation','prev_branch','current_branch','prev_unit.promotionDepartment','current_unit.promotionDepartment','prev_supervisor','current_supervisor')->orderBy('id','DESC')->get();
    }

    public function getSingelUser($id){

        $data['multi_values'] = User::with('branch', 'designation.department','designation.level', 'unit.department', 'supervisor')->where('id', $id)->first();
        //designation + units

        //=== find upper designation ===
        //get existing designation .. get existing level ... get upper level
        //using level whereIn designation
        $designationId = $data['multi_values']->designation_id;
        $val = Designation::find($designationId);
        $parentAry = [];
        $parentAry = $this->findParent($val->level_id, $parentAry);
        array_push($parentAry , $val->level_id); //push same level id

        $data['to_designation'] = Designation::with('department.units','level')->whereIn('level_id', $parentAry)->get();
        
        foreach($data['to_designation'] as $val){
            $designationIdAry[] = $val->id;
        }

        $data['to_supervisor'] = User::whereIn('designation_id', $designationIdAry)->where('id','!=',$id)->get();
        //===============================

        return $data;
    }
}
