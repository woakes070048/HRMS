<?php

namespace App\Http\Controllers\Pim;

use App\Models\BasicSalaryInfo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalaryInfoController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:hrms');
    }

    public function index(){

    	$data['title'] = "Salary Info";
    	$data['salaryInfo'] = BasicSalaryInfo::all();

    	return view('pim.salaryInfo', $data);
    }

    public function getAllInfo(){

    	return BasicSalaryInfo::all();
    }

    public function create(Request $request){

        $this->validate($request, [
            'info_name' => 'required',
            'info_amount' => 'required',
            'info_status' => 'required'
        ]);

        //return response()->json($request->info_amount);
        return response()->json();
    }
}
