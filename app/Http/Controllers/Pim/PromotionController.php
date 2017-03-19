<?php

namespace App\Http\Controllers\Pim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;

use App\Models\Promotion;

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

    	$data['title'] = "Promotions/Transfer";

        return view('pim.promotion', $data);
    }

    public function getPromotionsData(){

        return Promotion::with('user','prev_designation','current_designation','prev_branch','current_branch','prev_unit.promotionDepartment','current_unit.promotionDepartment','prev_supervisor','current_supervisor')->orderBy('id','DESC')->get();
    }
}
