<?php

namespace App\Http\Controllers\Pim;

use App\Models\EmployeeAddress;
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


    public function showEmployeeForm(Request $request){
        $data['designations'] = $this->designation->get();
        $data['police_stations'] = DB::table('police_stations')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['divisions'] = DB::table('divisions')->get();

        $data['sidevar_hide'] = 1;
        $data['tab'] = $request->tab;

        return view('pim.employee.add')->with($data);
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

        try{
            DB::beginTransaction();

            $user = User::create($request->all());

            $request->offsetSet('user_id',$user->id);
            EmployeeAddress::create($request->all());

            DB::commit();

            $request->session()->flash('success','Employee Successfully Added!');

            if($request->has('add_next')){
                return redirect('/employee/add/'.base64_encode($user->id).'/personal');
            }

            return redirect('/employee/add/'.base64_encode($user->id));

        }catch(\Exception $e){
            DB::rollback();
            $request->session()->flash('danger','Employee Not Added!');
            return redirect()->back()->withInput();
        }
    }







}
