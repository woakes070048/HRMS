<?php

namespace App\Http\Controllers\Pim;

use App\Models\Setup\UserEmails;

use App\Models\User;
use App\Models\Designation;
use App\Models\EmployeeDetail;
use App\Models\EmployeeAddress;
use App\Models\EmployeeEducation;
use App\Models\EmployeeExperience;

use App\Services\CommonService;

use App\Http\Requests\EmployeeBasicInfoRequest;
use App\Http\Requests\EmployeePersonalInfoRequest;
use App\Http\Requests\EmployeeEducationRequest;
use App\Http\Requests\EmployeeExperienceRequest;
use App\Http\Requests\DesignationRequest;

//use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{

    use CommonService;

    protected $auth;


    /**
     * EmployeeController constructor.
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


    /**
     * @get Show Employee list
     * @return $this
     */
    public function index(){
        $data['users'] = User::with('designation','createdBy')->orderBy('id','desc')->get();
        $data['sidevar_hide'] = 1;
        return view('pim.employee.index')->with($data);
    }


    /**
     * @get Show Employee Profile
     * @param null $employee_no
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function viewEmployeeProfile($employee_no=null){
        $sidevar_hide = 1;
        if(!empty($employee_no)){
            $user = User::with('designation','details','educations.institute.educationLevel','educations.degree')
                    ->where('employee_no',$employee_no)->first();
            if(!$user){
                return redirect()->back();
            }
        }else{
            $user = User::with('designation','details','educations.institute.educationLevel','educations.degree')->find($this->auth->id);
                // dd($user->details);
        }

        return view('pim.employee.view',compact('user','sidevar_hide'));
    }


    /**
     * @get Show Add Employee Form
     * @param Request $request
     * @return $this
     */
    public function showEmployeeForm(Request $request){

        $data['sidevar_hide'] = 1;
        $data['tab'] = $request->tab;

        if($user = User::find(base64_decode($request->id))){
            $data['user'] = $user;
            $data['id'] = $user->id;

            if($request->ajax()){

                if($request->tab == ''){
                     $basic = User::with('designation','address.presentDivision','address.presentDistrict','address.presentPoliceStation','address.permanentDivision','address.permanentDistrict','address.permanentPoliceStation')->find(base64_decode($request->id));
                     return response()->json($basic);
                }

                if($request->tab == 'personal'){
                    $personal = User::with('details.bloodGroup')->find(base64_decode($request->id));
                    // $personal = $user->details;
                    return response()->json($personal);
                }

                if($request->tab == 'experience'){
                     $experience = $user->experiences;
                     return response()->json($experience);
                }

                if($request->tab == 'education'){
                    $education = User::with('educations.institute.educationLevel','educations.degree')->find(base64_decode($request->id));
                     return response()->json($education);
                }
            }
        }

        return view('pim.employee.add')->with($data);
    }


    /**
     * Add Basic Information
     * @param EmployeeBasicInfoRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addEmployee(EmployeeBasicInfoRequest $request){

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

            if($request->hasFile('image')){
                $photo = time().'.'.$request->image->extension();
                $request->offsetSet('photo',$photo);
            }

            $user = User::create($request->all());

            if($user){
                if(isset($photo)){
                    if(!$request->image->storeAs($user->id,$photo)){
                        $request->session()->flash('warning','Photo Not Upload.Update photo form edit.');
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


    /**
     * @post Add Employee Personal Info
     * @param EmployeePersonalInfoRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addPersonalInfo(EmployeePersonalInfoRequest $request){
       try {
           $request->offsetSet('created_by',$this->auth->id);
            EmployeeDetail::create($request->all());
            $request->session()->flash('success','Employee Personal Info Successfully Saved!');

            if($request->has('save_personal_and_next')){
                return redirect('/employee/add/'.base64_encode($request->id).'/education');
            }
            return redirect('/employee/add/'.base64_encode($request->id).'/personal');

       }catch (\Exception $e){
           $request->session()->flash('danger','Employee Personal Info Not Saved!');
           return redirect()->back()->withInput();
       }
    }


    /**
     * @post Add Employee Education
     * @param EmployeeEducationRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addEducation(EmployeeEducationRequest $request){

        try{
            $request->offsetSet('created_by', $this->auth->id);

            if($request->hasFile('certificate_file')){
                $certificate = time().'.'.$request->certificate_file->extension();
                $request->offsetSet('certificate',$certificate);
                $request->certificate_file->storeAs($request->user_id, $certificate);
            }

            if(EmployeeEducation::create($request->all())){
                $data['data'] = User::with('educations.institute.educationLevel','educations.degree')->find($request->user_id);
            }else{
                if(isset($certificate)) {
                    Storage::delete($certificate);
                }
            }

            if($request->ajax()){
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_education_and_next'))?'experience':null;
                $data['title'] = 'Success!';
                $data['message'] = 'Education Successfully Saved.';
                return response()->json($data,200);
            }

            $request->session()->flash('success','Education Successfully Saved.');

            if($request->has('save_education_and_next')){
                return redirect('/employee/add/'.base64_encode($request->id).'/experience');
            }
            return redirect('/employee/add/'.base64_encode($request->id).'/education');


        }catch(\Exception $e){

            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['type'] = null;
                $data['title'] = 'Error!';
                $data['message'] = 'Employee Education Not Saved.';
                return response()->json($data,500);
            }

            $request->session()->flash('danger','Education Not Saved.');
            return redirect()->back()->withInput();
        }
    }


    public function addDesignation(DesignationRequest $request){
        try{
            $request->offsetSet('created_by', $this->auth->id);
            $data['data'] = Designation::create($request->all());

            if($request->ajax()){
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['title'] = 'Success!';
                $data['message'] = 'Designation Successfully Added.';
                return response()->json($data,200);
            }

            $request->session()->flash('success','Designation Successfully Added.');
            return redirect()->back();

        }catch(\Exception $e){
            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['title'] = 'Error!';
                $data['message'] = 'Designation Not Saved.';
                $data['data'] = '';
                return response()->json($data,500);
            }

            $request->session()->flash('danger','Designation Not Added.');
            return redirect()->back()->withInput();
        }
    }


    /**
     * @post Add Employee Experience
     * @param EmployeeExperienceRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addExperience(EmployeeExperienceRequest $request){
//        dd($request->all());
        try{
            $request->offsetSet('created_by', $this->auth->id);
            $data['data'] = EmployeeExperience::create($request->all());

            if($request->ajax()){
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_experience_and_next'))?'salary':null;
                $data['title'] = 'Success!';
                $data['message'] = 'Experience Successfully Saved.';
                return response()->json($data,200);
            }

            $request->session()->flash('success','Experience Successfully Saved.');

            if($request->has('save_experience_and_next')){
                return redirect('/employee/add/'.base64_encode($request->id).'/salary');
            }
            return redirect('/employee/add/'.base64_encode($request->id).'/experience');

        }catch(\Exception $e){

            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['type'] = null;
                $data['title'] = 'Error!';
                $data['message'] = 'Experience Not Saved.';
                return response()->json($data,500);
            }

            $request->session()->flash('danger','Experience Not Saved.');
            return redirect()->back()->withInput();
        }
    }




}
