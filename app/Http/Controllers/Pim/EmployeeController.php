<?php

namespace App\Http\Controllers\Pim;


use App\Models\EmployeeSalaryAccount;
use App\Models\Setup\UserEmails;

use App\Models\User;
use App\Models\EmployeeDetail;
use App\Models\EmployeeAddress;
use App\Models\EmployeeEducation;
use App\Models\EmployeeExperience;
use App\Models\EmployeeSalary;
use App\Models\EmployeeNominee;
use App\Models\EmployeeTraining;
use App\Models\EmployeeReference;
use App\Models\EmployeeChildren;
use App\Models\EmployeeLanguage;

use App\Services\CommonService;

use App\Http\Requests\EmployeeBasicInfoRequest;
use App\Http\Requests\EmployeePersonalInfoRequest;
use App\Http\Requests\EmployeeEducationRequest;
use App\Http\Requests\EmployeeExperienceRequest;
use App\Http\Requests\EmployeeSalaryRequest;
use App\Http\Requests\EmployeeTrainingRequest;
use App\Http\Requests\EmployeeNomineeRequest;
use App\Http\Requests\EmployeeReferenceRequest;
use App\Http\Requests\EmployeeChildrenRequest;
use App\Http\Requests\EmployeeLanguageRequest;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use File;

class EmployeeController extends Controller
{

    use CommonService;

    protected $auth;


    /**
     * EmployeeController constructor.
     * @param Auth $auth
     */
    public function __construct(Auth $auth,User $user)
    {
        $this->middleware('auth:hrms');

        $this->middleware(function($request, $next){
            $this->auth = Auth::guard('hrms')->user();
            view()->share('auth',$this->auth);
            return $next($request);
        });

        $this->user = $user;

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
            $user = $this->user->get_profile_info($employee_no);
            if(!$user){
                return redirect()->back();
            }
        }else{
            $user = $this->user->get_profile_info($this->auth->id);
        }

        return view('pim.employee.view',compact('user','sidevar_hide'));
    }


    /**
     * @get Show Add Employee Form
     * @param Request $request
     * @return $this
     */
    public function showEmployeeAddForm(Request $request){

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
                    $personal = $user->with('details.bloodGroup')->first();
                    return response()->json($personal);
                }

                if($request->tab == 'experience'){
                     $experience = $user->experiences;
                     return response()->json($experience);
                }

                if($request->tab == 'education'){
                    $education = $user->with('educations.institute.educationLevel','educations.degree')->first();
                     return response()->json($education);
                }

                if($request->tab == 'salary'){
                     $salaries = $user->with('salaries.basicSalaryInfo','salaryAccount')->first();
                     return response()->json($salaries);
                }

                if($request->tab == 'nominee'){
                     $nominee = $user->nominees;
                     return response()->json($nominee);
                }

                if($request->tab == 'training'){
                    $training = $user->trainings;
                    return response()->json($training);
                }

                if($request->tab == 'reference'){
                    $references = $user->references;
                    return response()->json($references);
                }

                if($request->tab == 'children'){
                    $childrens = $user->childrens;
                    return response()->json($childrens);
                }

                if($request->tab == 'language'){
                    $languages = $user->with('languages.language')->first();
                    return response()->json($languages);
                }
            }
        }else{
            $employee_no = User::orderBy('id','desc')->first();
            $data['next_employee_id'] = $employee_no->next_employee_no;
        }

        return view('pim.employee.add')->with($data);
    }


    /**
     * Create Employee Account with Basic Information
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
            if(EmployeeDetail::create($request->all())){
                $data['data'] = User::with('details.bloodGroup')->find($request->user_id);
            }

           if($request->ajax()){
               $data['status'] = 'success';
               $data['statusType'] = 'OK';
               $data['code'] = 200;
               $data['type'] = ($request->has('save_personal_and_next'))?'education':null;
               $data['title'] = 'Success!';
               $data['message'] = 'Personal Info Successfully Saved.';
               return response()->json($data,200);
           }

            $request->session()->flash('success','Personal Info Successfully Saved.');

            if($request->has('save_personal_and_next')){
                return redirect('/employee/add/'.base64_encode($request->id).'/education');
            }
            return redirect('/employee/add/'.base64_encode($request->id).'/personal');

       }catch (\Exception $e){
           if($request->ajax()){
               $data['status'] = 'danger';
               $data['statusType'] = 'NotOk';
               $data['code'] = 500;
               $data['type'] = null;
               $data['title'] = 'Error!';
               $data['message'] = 'Personal Info Not Saved.';
               return response()->json($data,500);
           }

           $request->session()->flash('danger','Personal Info Not Saved.');
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
                    File::delete('files/'.$request->user_id.'/'.$certificate);
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


    /**
     * @post Add Employee Experience
     * @param EmployeeExperienceRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addExperience(EmployeeExperienceRequest $request){
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


    /**
     * @post Add Employee Salary
     * @param EmployeeSalaryRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addSalary(EmployeeSalaryRequest $request){
        //dd($request->all());
        DB::beginTransaction();
//        try{
            $request->offsetSet('created_by', $this->auth->id);

            User::where('id',$request->user_id)->update([
                'basic_salary' => $request->basic_salary,
                'effective_date' => $request->effective_date,
            ]);

            if($request->has('salary_info')){
                $salary_info = $request->salary_info;
                $saveData = [];
                foreach($salary_info as $sinfo){
                    if(!empty($sinfo['id']) && !empty($sinfo['amount'])) {
                        $saveData[] = [
                            'user_id' => $request->user_id,
                            'basic_salary_info_id' => $sinfo['id'],
                            'salary_amount' => $sinfo['amount'],
                            'salary_amount_type' => $sinfo['type'],
                            'salary_effective_date' => ($sinfo['effective_date'])?:date('Y-m-d'),
                            'created_by' => $this->auth->id,
                            'created_at' => date('Y-m-d')
                        ];
                    }
                }
                EmployeeSalary::insert($saveData);
            }

            if($request->has('bank_id') && $request->has('bank_account_no')){
                EmployeeSalaryAccount::create($request->all());
            }

            DB::commit();

            if($request->ajax()){
                $data['data'] = User::with('salaries.basicSalaryInfo','salaryAccount')->find($request->user_id);
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_salary_and_next'))?'nominee':null;
                $data['title'] = 'Success!';
                $data['message'] = 'Salary Successfully Saved.';
                return response()->json($data,200);
            }

            $request->session()->flash('success','Salary Successfully Saved.');

            if($request->has('save_salary_and_next')){
                return redirect('/employee/add/'.base64_encode($request->id).'/nominee');
            }
            return redirect('/employee/add/'.base64_encode($request->id).'/salary');

//        }catch(\Exception $e){
//            DB::rollback();
//
//            if($request->ajax()){
//                $data['status'] = 'danger';
//                $data['statusType'] = 'NotOk';
//                $data['code'] = 500;
//                $data['type'] = null;
//                $data['title'] = 'Error!';
//                $data['message'] = 'Salary Not Saved.';
//                return response()->json($data,500);
//            }
//
//            $request->session()->flash('danger','Experience Not Saved.');
//            return redirect()->back()->withInput();
//        }
    }


    /**
     * @param EmployeeNomineeRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function addNominee(EmployeeNomineeRequest $request){
         try{
            $request->offsetSet('created_by', $this->auth->id);

            if($request->hasFile('image')){
                $image = time().'.'.$request->image->extension();
                $request->offsetSet('nominee_photo',$image);
                $request->image->storeAs($request->user_id, $image);
            }

            $data['data'] = EmployeeNominee::create($request->all());

            if($request->ajax()){
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_nominee_and_next'))?'training':null;
                $data['title'] = 'Success!';
                $data['message'] = 'Nominee Successfully Added.';
                return response()->json($data,200);
            }

            $request->session()->flash('success','Nominee Successfully Added.');
            return redirect()->back();

         }catch(\Exception $e){
             if($request->ajax()){
                 $data['status'] = 'danger';
                 $data['statusType'] = 'NotOk';
                 $data['code'] = 500;
                 $data['title'] = 'Error!';
                 $data['message'] = 'Nominee Not Saved.';
                 $data['data'] = '';
                 return response()->json($data,500);
             }

             $request->session()->flash('danger','Nominee Not Added.');
             return redirect()->back()->withInput();
         }
    }



    /**
     * @post Add Employee Training
     * @param EmployeeTrainingRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addTraining(EmployeeTrainingRequest $request){
        try{
            $request->offsetSet('created_by', $this->auth->id);
            $data['data'] = EmployeeTraining::create($request->all());

            if($request->ajax()){
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_training_and_next'))?'reference':null;
                $data['title'] = 'Success!';
                $data['message'] = 'Experience Successfully Saved.';
                return response()->json($data,200);
            }

            $request->session()->flash('success','Training Successfully Saved.');

            if($request->has('save_training_and_next')){
                return redirect('/employee/add/'.base64_encode($request->id).'/reference');
            }
            return redirect('/employee/add/'.base64_encode($request->id).'/training');

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

            $request->session()->flash('danger','Training Not Saved.');
            return redirect()->back()->withInput();
        }
    }



    /**
     * @post Add Employee Reference
     * @param EmployeeReferenceRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addReference(EmployeeReferenceRequest $request){
        try{
            $request->offsetSet('created_by', $this->auth->id);
            $data['data'] = EmployeeReference::create($request->all());

            if($request->ajax()){
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_reference_and_next'))?'children':null;
                $data['title'] = 'Success!';
                $data['message'] = 'Reference Successfully Saved.';
                return response()->json($data,200);
            }

            $request->session()->flash('success','Reference Successfully Saved.');

            if($request->has('save_reference_and_next')){
                return redirect('/employee/add/'.base64_encode($request->id).'/children');
            }
            return redirect('/employee/add/'.base64_encode($request->id).'/reference');

        }catch(\Exception $e){

            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['type'] = null;
                $data['title'] = 'Error!';
                $data['message'] = 'Reference Not Saved.';
                return response()->json($data,500);
            }

            $request->session()->flash('danger','Experience Not Saved.');
            return redirect()->back()->withInput();
        }
    }


    /**
     * @post Add Employee Children
     * @param EmployeeChildrenRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addChildren(EmployeeChildrenRequest $request){
        try{
            $request->offsetSet('created_by', $this->auth->id);
            $data['data'] = EmployeeChildren::create($request->all());

            if($request->ajax()){
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_children_and_next'))?'language':null;
                $data['title'] = 'Success!';
                $data['message'] = 'Children Successfully Saved.';
                return response()->json($data,200);
            }

            $request->session()->flash('success','Children Successfully Saved.');

            if($request->has('save_children_and_next')){
                return redirect('/employee/add/'.base64_encode($request->id).'/language');
            }
            return redirect('/employee/add/'.base64_encode($request->id).'/children');

        }catch(\Exception $e){

            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['type'] = null;
                $data['title'] = 'Error!';
                $data['message'] = 'Children Not Saved.';
                return response()->json($data,500);
            }

            $request->session()->flash('danger','Experience Not Saved.');
            return redirect()->back()->withInput();
        }
    }


    /**
     * @post Add Employee Language
     * @param EmployeeLanguageRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addLanguage(EmployeeLanguageRequest $request){
        try{
            $request->offsetSet('created_by', $this->auth->id);

            if(EmployeeLanguage::create($request->all())){
                $data['data'] = User::with('languages.language')->find($request->id);
            }

            if($request->ajax()){
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = null;
                $data['title'] = 'Success!';
                $data['message'] = 'Language Successfully Saved.';
                return response()->json($data,200);
            }

            $request->session()->flash('success','Language Successfully Saved.');
            return redirect('/employee/add/'.base64_encode($request->id).'/language');

        }catch(\Exception $e){

            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['type'] = null;
                $data['title'] = 'Error!';
                $data['message'] = 'Language Not Saved.';
                return response()->json($data,500);
            }

            $request->session()->flash('danger','Language Not Saved.');
            return redirect()->back()->withInput();
        }
    }


/********************************** Edit Employee *************************************************/
    public function showEmployeeEditForm(Request $request){
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
                    $personal = $user->with('details.bloodGroup')->first();
                    return response()->json($personal);
                }

                if($request->tab == 'experience'){
                    $experience = $user->experiences;
                    return response()->json($experience);
                }

                if($request->tab == 'education'){
                    $education = $user->with('educations.institute.educationLevel','educations.degree')->first();
                    return response()->json($education);
                }

                if($request->tab == 'salary'){
                    $salaries = $user->with('salaries.basicSalaryInfo','salaryAccount')->first();
                    return response()->json($salaries);
                }

                if($request->tab == 'nominee'){
                    $nominee = $user->nominees;
                    return response()->json($nominee);
                }

                if($request->tab == 'training'){
                    $training = $user->trainings;
                    return response()->json($training);
                }

                if($request->tab == 'reference'){
                    $references = $user->references;
                    return response()->json($references);
                }

                if($request->tab == 'children'){
                    $childrens = $user->childrens;
                    return response()->json($childrens);
                }

                if($request->tab == 'language'){
                    $languages = $user->with('languages.language')->first();
                    return response()->json($languages);
                }
            }
        }else{
            return redirect()->back();
        }

        return view('pim.employee.edit')->with($data);
    }



    /**
     * Update Employee Account with Basic Information
     * @param EmployeeBasicInfoRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editEmployee(Request $request){

        try{
            Artisan::call('db:connect');

            UserEmails::where('email',$request->email)->where('config_id',Session('config_id'))->update([
                'email' => $request->email,
            ]);

            Artisan::call("db:connect", ['database' => Session('database')]);
            DB::beginTransaction();

            if($request->hasFile('image')){
                $photo = time().'.'.$request->image->extension();
                if($request->image->storeAs($request->id,$photo)){
                    if($request->has('old_image')) {
                        File::delete('files/'.$request->id.'/'.$request->old_image);
                    }
                }else{
                    $request->session()->flash('warning','Photo Not Upload.Update photo form edit.');
                }
                $request->offsetSet('photo',$photo);
            }

            User::find($request->id)->update($request->all());
            EmployeeAddress::findUser($request->id)->update($request->all());

            DB::commit();

            $request->session()->flash('success','Employee Successfully Update!');

            if($request->has('update_next')){
                return redirect('/employee/edit/'.base64_encode($request->id).'/personal');
            }

            return redirect('/employee/edit/'.base64_encode($request->id));

        }catch(\Exception $e){
            DB::rollback();
            $request->session()->flash('danger','Employee Not Update!');
            return redirect()->back()->withInput();
        }
    }


}
