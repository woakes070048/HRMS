<?php

namespace App\Http\Controllers\Pim;

use App\Models\Branch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
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

    	$data['title'] = "Company Branch";
    	return view('pim.branch', $data);
    }

    public function getBranch(){

        return Branch::orderBy('id', 'DESC')->get();
    }

    public function create(Request $request){

        $this->validate($request, [
            'branch_name' => 'required',
            'branch_mobile' => 'required',
            'branch_location' => 'required',
        ]);

        //try{

            $data['data'] = Branch::create([
                'branch_name' => $request->branch_name,
                'branch_email' => $request->branch_email,
                'branch_mobile' => $request->branch_mobile,
                'branch_phone' => $request->branch_phone,
                'branch_location' => $request->branch_location,
                'branch_status' => $request->branch_status,
            ]);
        
            $data['title'] = 'success';
            $data['message'] = 'unit successfully added!';

        //}catch (\Exception $e) {
            
           // $data['title'] = 'danger';
            //$data['message'] = 'unit not added!';
        //}

        return response()->json($data);
    }
}
