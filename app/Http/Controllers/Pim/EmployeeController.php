<?php

namespace App\Http\Controllers\Pim;

use App\Models\User;
use App\Models\Designation;
use App\Http\Requests\AddEmployeeRequest;

use App\Services\CommonService;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    use CommonService;

    protected $auth;

    protected $designation;

    public function __construct(Designation $designation)
    {
        $this->middleware('auth:hrms');

        $this->designation = $designation;

        $this->middleware(function($request, $next){
           $this->auth = Auth::guard('hrms')->user();
            return $next($request);
        });
    }


    public function index(){
        return view('pim.employee.index');
    }


    public function showEmployeeForm(){
        $designations = $this->designation->get();
        $police_stations = DB::table('police_stations')->get();
        $districts = DB::table('districts')->get();
        $divisions = DB::table('divisions')->get();

        return view('pim.employee.add', compact('designations','divisions','police_stations','districts'));
    }


    public function addEmployee(AddEmployeeRequest $request){

        if($request->hasFile('image')){
            $photo = time().'.'.$request->image->extension();
            $request->offsetSet('photo',$photo);

            if(!$request->image->storeAs($this->auth->id,$photo)){
                $request->session()->flash('warning','Photo Not Upload.Try Again!');
                return redirect()->back()->withInput();
            }
        }

        $request->offsetSet('password', bcrypt($request->password));
        $request->offsetSet('created_by',$this->auth->id);

        if($user = User::create($request->all())){
            $request->session()->flash('success','Employee Successfully Added!');
            return redirect('/employee/add/'.$user->id.'/');
        }else{
            $request->session()->flash('danger','Employee Successfully Added!');
            return redirect()->back()->withInput();
        }
    }







}
