<?php

namespace App\Http\Controllers\Pim;

use App\Models\BasicSalaryInfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SalaryInfoController extends Controller
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

    	$data['title'] = "Salary Info";
    	$data['salaryInfo'] = BasicSalaryInfo::all();

    	return view('pim.salaryInfo', $data);
    }

    public function getAllInfo(){

    	return BasicSalaryInfo::orderBy('id','DESC')->get();
    }

    public function create(Request $request){

        $this->validate($request, [
            'info_name' => 'required',
            'info_amount' => 'required',
            'info_status' => 'required'
        ]);

        try {

        $data['data'] = BasicSalaryInfo::create([
            'name' => $request->info_name,
            'amount' => $request->info_amount,
            'amount_satatus' => $request->info_status,
        ]);
    
            $data['title'] = 'Success';
            $data['message'] = 'Salary info successfully added!';
             return response()->json($data);

        } catch (\Exception $e) {
            DB::rollback();
            $data['title'] = 'Error';
            $data['message'] = 'Salary info not added!';
             return response()->json($data,500);
        }

       
    }
}
