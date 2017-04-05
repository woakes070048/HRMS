<?php

namespace App\Http\Controllers\Setup;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ModuleController extends Controller
{
    public function __construct(){
        $this->middleware('auth:setup');
    }

    public function index(){
    	$data['title'] = "Setup Modules";

    	return view('setup.module', $data);
    }

    public function create(Request $request){

        $this->validate($request, [
            'module_name' => 'required',
            'module_status' => 'required',
        ]);

        // echo $request->module_name;
        // echo $request->module_details;
        // echo $request->module_status;

        try{
            // $data['data'] = Branch::create([
            //     'branch_name' => $request->branch_name,
            //     'branch_email' => $request->branch_email,
            //     'branch_mobile' => $request->branch_mobile,
            //     'branch_phone' => $request->branch_phone,
            //     'branch_location' => $request->branch_location,
            //     'branch_status' => $request->branch_status,
            // ]);
        
            $data['title'] = 'success';
            $data['message'] = 'data successfully added!';

        }catch (\Exception $e) {
            
           	$data['title'] = 'danger';
            $data['message'] = 'data not added!';
        }

        return response()->json($data);
    }
}
