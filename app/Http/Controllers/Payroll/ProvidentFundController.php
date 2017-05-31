<?php

namespace App\Http\Controllers\Payroll;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProvidentFundController extends Controller
{
	protected $auth;

    public function __construct(Auth $auth){
    	$this->middleware('auth:hrms');

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            view()->share('auth',$this->auth);
            return $next($request);
        });
    }


    public function index(Request $request)
    {
    	if($request->ajax()){
    		return Increment::with('user','incrementType','approvedBy','createdBy','updatedBy')->orderBy('id','desc')->get();
    	}
        $data['sidebar_hide'] = true;
    	return view('payroll.increment')->with($data);
    }


}
