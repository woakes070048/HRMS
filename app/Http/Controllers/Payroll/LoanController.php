<?php

namespace App\Http\Controllers\Payroll;

use App\Models\Loan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoanController extends Controller
{
    protected $auth;

    /**
     * LoanController constructor.
     * @param Auth $auth
     */
    public function __construct(Auth $auth)
    {
        $this->middleware('auth:hrms');

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            view()->share('auth',$this->auth);
            return $next($request);
        });
    }


    public function index(Request $request){
    	if($request->ajax()){
    		return Loan::with('user','loanType','createdBy','updatedBy')->orderBy('id','desc')->get();
    	}

		$data['sidebar_hide'] = true;
    	return view('payroll.loan')->with($data);
    	
    }




}
