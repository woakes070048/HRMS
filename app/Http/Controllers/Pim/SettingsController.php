<?php

namespace App\Http\Controllers\Pim;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
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

    	$data['title'] = "Settings";
    	return view('pim.settings', $data);
    }

    public function getSettings(){
        
        return Setting::orderBy('id','DESC')->get();
    }

    public function create(Request $request){

        $this->validate($request, [
            'field_name' => 'required',
            'field_value' => 'required',
        ],
        [
            'field_name.required' => 'The name field is required.',
            'field_value.required'     => 'The value field is required.',
        ]);

        try{

            $data['data'] = Setting::create([
                'field_name' => $request->field_name,
                'field_value' => $request->field_value,
            ]);
        
            $data['title'] = 'success';
            $data['message'] = 'settings successfully added!';

        }catch (\Exception $e){
            
            $data['title'] = 'danger';
            $data['message'] = 'settings not added!';
        }

        return response()->json($data);
    }

    public function update(Request $request){

        $this->validate($request, [
            'edit_field_value' => 'required',
        ],
        [
            'edit_field_value.required'     => 'The value field is required.',
        ]);

        $data['field_value'] = $request->edit_field_value;

        try{

            $data['data'] = Setting::where('id',$request->hdn_id)->update([
                'field_value' => $request->edit_field_value,
            ]);
        

            $data['title'] = 'success';
            $data['message'] = 'settings successfully updated!';

        }catch (\Exception $e) {
            
            $data['title'] = 'danger';
            $data['message'] = 'settings not added!';
        }

        return response()->json($data);
    }
}
