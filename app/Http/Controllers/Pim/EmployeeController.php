<?php

namespace App\Http\Controllers\Pim;

use App\Models\User;
use App\Models\Designation;
use App\Models\EmployeeAddress;
use App\Models\Setup\UserEmails;

use App\Services\CommonService;
use App\Http\Requests\AddEmployeeRequest;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{

    use CommonService;

    protected $auth;

    protected $designation;

    /**
     * EmployeeController constructor.
     * @param Designation $designation
     */
    public function __construct(Designation $designation)
    {
        $this->middleware('auth:hrms');

        $this->designation = $designation;

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            return $next($request);
        });
    }


    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $data['users'] = User::all();
        $data['sidevar_hide'] = 1;
        return view('pim.employee.index')->with($data);
    }


    /**
     * @param Request $request
     * @return $this
     */
    public function showEmployeeForm(Request $request){
        $data['designations'] = $this->designation->get();
        $data['police_stations'] = DB::table('police_stations')->get();
        $data['districts'] = DB::table('districts')->get();
        $data['divisions'] = DB::table('divisions')->get();
        $data['blood_groups'] = DB::table('blood_groups')->get();

        $data['sidevar_hide'] = 1;
        $data['tab'] = $request->tab;

        if($user = User::find(base64_decode($request->id))){
            $data['user'] = $user;
            $data['id'] = base64_decode($request->id);
        }else{
            $data['user'] =  new User;
        }

        return view('pim.employee.add')->with($data);
    }


    /**
     * @param AddEmployeeRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addEmployee(AddEmployeeRequest $request){

        $request->offsetSet('password', bcrypt($request->password));
        $request->offsetSet('created_by',$this->auth->id);

        try{

            Artisan::call('db:connect');
            if(UserEmails::where('email',$request->email)->count() <= 0){
                UserEmails::create([
                    'config_id' => Session('config_id'),
                    'email' => $request->email,
                ]);
            }else{
                $request->session()->flash('danger','Employee Email Already Exits!');
                return redirect()->back()->withInput();
            }

            Artisan::call("db:connect", ['database' => Session('database')]);
            DB::beginTransaction();

            $user = User::create($request->all());

            if($user){
                if($request->hasFile('image')){
                    $photo = time().'.'.$request->image->extension();
                    $request->offsetSet('photo',$photo);

                    if(!$request->image->storeAs($user->id,$photo)){
                        $request->session()->flash('warning','Photo Not Upload.Try Again!');
//                        return redirect()->back()->withInput();
                    }
                }
            }

            $request->offsetSet('user_id',$user->id);
            EmployeeAddress::create($request->all());

            DB::commit();

            $request->session()->flash('success','Employee Successfully Added!');

            if($request->has('save_next')){
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
