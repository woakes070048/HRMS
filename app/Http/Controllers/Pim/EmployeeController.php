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

        if($user = User::find($request->id)){
            $data['user'] = $user;
            $data['id'] = $user->id;

            if($request->ajax()){
                return $this->user->get_user_data_by_user_tab($user->id, $request->tab);
            }
        }else{
            if($request->ajax()){
                return response()->json([]);
            }
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

            if($request->ajax()){
                $userData = $this->user->get_user_data_by_user_tab($user->id, $request->tab);
                $data['data'] = $userData->original;
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_next'))?'personal':null;
                $data['title'] = 'Success!';
                $data['message'] = 'Employee Successfully Added!';
                return response()->json($data,200);
            }

            $request->session()->flash('success','Employee Successfully Added!');

            if($request->has('save_next')){
                return redirect('/employee/add/'.$user->id.'/personal');
            }

            return redirect('/employee/add/'.$user->id);

        }catch(\Exception $e){
            DB::rollback();

            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['type'] = null;
                $data['title'] = 'Error!';
                $data['message'] = 'Personal Info Not Saved.';
                return response()->json($data,500);
            }

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
                $data['data'] = User::with('details.bloodGroup')->find($request->userId);
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
                return redirect('/employee/add/'.$request->userId.'/education');
            }
            return redirect('/employee/add/'.$request->userId.'/personal');

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
     * @post Add And Edit Education Employee Education
     * @param EmployeeEducationRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addEditEducation(EmployeeEducationRequest $request){
        try{
            $message = '';
            if($request->hasFile('certificate_file')){
                $certificate = time().'.'.$request->certificate_file->extension();
                $request->offsetSet('certificate',$certificate);
                if($request->certificate_file->storeAs($request->userId, $certificate)){
                    if($request->has('old_image')) {
                        File::delete('files/'.$request->userId.'/'.$request->old_image);
                    }
                }
            }

            if($request->id) {
                $message = 'Education Successfully Update.';
                $request->offsetSet('updated_by', $this->auth->id);
                if(!EmployeeEducation::find($request->id)->update($request->all())){
                    if(isset($certificate)) {
                        File::delete('files/'.$request->userId.'/'.$certificate);
                    }
                }
            }else{
                $message = 'Education Successfully Saved.';
                $request->offsetSet('created_by', $this->auth->id);
                if(!EmployeeEducation::create($request->all())){
                    if(isset($certificate)) {
                        File::delete('files/'.$request->userId.'/'.$certificate);
                    }
                }
            }

            if($request->ajax()){
                $education = $this->user->get_user_data_by_user_tab($request->userId,'education');
                $data['data'] = $education->original;
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_education_and_next'))?'experience':null;
                $data['title'] = 'Success!';
                $data['message'] = $message;
                return response()->json($data,200);
            }

            $request->session()->flash('success',$message);
            return redirect()->back();

        }catch(\Exception $e){

            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['type'] = null;
                $data['title'] = 'Error!';
                $data['message'] = 'Education Successfully Saved.';
                return response()->json($data,500);
            }

            $request->session()->flash('danger','Education Successfully Saved.');
            return redirect()->back()->withInput();
        }
    }


    /**
     * @post Add Employee Experience
     * @param EmployeeExperienceRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addEditExperience(EmployeeExperienceRequest $request){
        // dd($request->all());
        try{
            $message = '';
            if($request->id) {
                $message = 'Experience Successfully Update.';
                $request->offsetSet('updated_by', $this->auth->id);
                EmployeeExperience::find($request->id)->update($request->all());
            }else{
                $message = 'Experience Successfully Saved.';
                $request->offsetSet('created_by', $this->auth->id);
                EmployeeExperience::create($request->all());
            }

            if($request->ajax()){
                $experience = $this->user->get_user_data_by_user_tab($request->userId,'experience');
                $data['data'] = $experience->original;
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_experience_and_next'))?'salary':null;
                $data['title'] = 'Success!';
                $data['message'] = $message;
                return response()->json($data,200);
            }

            $request->session()->flash('success',$message);
            return redirect()->back();

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

        DB::beginTransaction();
        try{
            $request->offsetSet('created_by', $this->auth->id);

            User::where('id',$request->userId)->update([
                'basic_salary' => $request->basic_salary,
                'salary_in_cache' => $request->salary_in_cache,
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
                $data['data'] = User::with('salaries.basicSalaryInfo','salaryAccount')->find($request->userId);
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
                return redirect('/employee/add/'.$request->userId.'/nominee');
            }
            return redirect('/employee/add/'.$request->userId.'/salary');

        }catch(\Exception $e){
            DB::rollback();

            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['type'] = null;
                $data['title'] = 'Error!';
                $data['message'] = 'Salary Not Saved.';
                return response()->json($data,500);
            }

            $request->session()->flash('danger','Salary Not Saved.');
            return redirect()->back()->withInput();
        }
    }


    /**
     * @param EmployeeNomineeRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function addEditNominee(EmployeeNomineeRequest $request){
         try{
             $message = '';
            if($request->hasFile('image')){
                $image = time().'.'.$request->image->extension();
                $request->offsetSet('nominee_photo',$image);
                if($request->image->storeAs($request->userId, $image)){
                    if($request->has('old_image')) {
                        File::delete('files/'.$request->userId.'/'.$request->old_image);
                    }
                }
            }

             if($request->id) {
                 $message = 'Nominee Successfully Update.';
                 $request->offsetSet('updated_by', $this->auth->id);
                 if(!EmployeeNominee::find($request->id)->update($request->all())){
                     if(isset($image)) {
                         File::delete('files/'.$request->userId.'/'.$image);
                     }
                 }
             }else{
                 $message = 'Nominee Successfully Saved.';
                 $request->offsetSet('created_by', $this->auth->id);
                 if(!EmployeeNominee::create($request->all())){
                     if(isset($image)) {
                         File::delete('files/'.$request->userId.'/'.$image);
                     }
                 }
             }

            if($request->ajax()){
                $nominee = $this->user->get_user_data_by_user_tab($request->userId,'nominee');
                $data['data'] = $nominee->original;
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_nominee_and_next'))?'training':null;
                $data['title'] = 'Success!';
                $data['message'] = $message;
                return response()->json($data,200);
            }

            $request->session()->flash('success',$message);
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

             $request->session()->flash('danger','Nominee Not Saved.');
             return redirect()->back()->withInput();
         }
    }



    /**
     * @post Add Employee Training
     * @param EmployeeTrainingRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addEditTraining(EmployeeTrainingRequest $request){
        try{
            $message = '';
            if($request->id) {
                $message = 'Training Successfully Update.';
                $request->offsetSet('updated_by', $this->auth->id);
                EmployeeTraining::find($request->id)->update($request->all());
            }else{
                $message = 'Training Successfully Saved.';
                $request->offsetSet('created_by', $this->auth->id);
                EmployeeTraining::create($request->all());
            }

            if($request->ajax()){
                $training = $this->user->get_user_data_by_user_tab($request->userId,'training');
                $data['data'] = $training->original;
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_training_and_next'))?'reference':null;
                $data['title'] = 'Success!';
                $data['message'] = $message;
                return response()->json($data,200);
            }

            $request->session()->flash('success',$message);
            return redirect()->back();

        }catch(\Exception $e){
            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['type'] = null;
                $data['title'] = 'Error!';
                $data['message'] = 'Training Not Saved.';
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
    public function addEditReference(EmployeeReferenceRequest $request){
        try{

            $message = '';
            if($request->id) {
                $message = 'Reference Successfully Update.';
                $request->offsetSet('updated_by', $this->auth->id);
                EmployeeReference::find($request->id)->update($request->all());
            }else{
                $message = 'Reference Successfully Saved.';
                $request->offsetSet('created_by', $this->auth->id);
                EmployeeReference::create($request->all());
            }

            if($request->ajax()){
                $reference = $this->user->get_user_data_by_user_tab($request->userId,'reference');
                $data['data'] = $reference->original;
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_reference_and_next'))?'children':null;
                $data['title'] = 'Success!';
                $data['message'] = 'Reference Successfully Saved.';
                return response()->json($data,200);
            }

            $request->session()->flash('success',$message);
            return redirect()->back();

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

            $request->session()->flash('danger','Reference Not Saved.');
            return redirect()->back()->withInput();
        }
    }


    /**
     * @post Add Employee Children
     * @param EmployeeChildrenRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addEditChildren(EmployeeChildrenRequest $request){
        try{
            $message = '';
            if($request->id) {
                $message = 'Children Successfully Update.';
                $request->offsetSet('updated_by', $this->auth->id);
                EmployeeChildren::find($request->id)->update($request->all());
            }else{
                $message = 'Children Successfully Saved.';
                $request->offsetSet('created_by', $this->auth->id);
                EmployeeChildren::create($request->all());
            }

            if($request->ajax()){
                $children = $this->user->get_user_data_by_user_tab($request->userId,'children');
                $data['data'] = $children->original;
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_children_and_next'))?'language':null;
                $data['title'] = 'Success!';
                $data['message'] = $message;
                return response()->json($data,200);
            }

            $request->session()->flash('success',$message);
            return redirect()->back();

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

            $request->session()->flash('danger','Children Not Saved.');
            return redirect()->back()->withInput();
        }
    }


    /**
     * @post Add Employee Language
     * @param EmployeeLanguageRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function addEditLanguage(EmployeeLanguageRequest $request){
        try{

            $message = '';
            if($request->id) {
                $message = 'Language Successfully Update.';
                $request->offsetSet('updated_by', $this->auth->id);
                EmployeeLanguage::find($request->id)->update($request->all());
            }else{
                $message = 'Language Successfully Saved.';
                $request->offsetSet('created_by', $this->auth->id);
                EmployeeLanguage::create($request->all());
            }

            if($request->ajax()){
                $language = $this->user->get_user_data_by_user_tab($request->userId,'language');
                $data['data'] = $language->original;
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = null;
                $data['title'] = 'Success!';
                $data['message'] = $message;
                return response()->json($data,200);
            }

            $request->session()->flash('success',$message);
            return redirect()->back();

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




/********************************** Edit Employee Information Functions *************************************************/

    public function showEmployeeEditForm(Request $request){
        $data['sidevar_hide'] = 1;
        $data['tab'] = $request->tab;

        if($user = User::find($request->id)){
            $data['user'] = $user;
            $data['id'] = $user->id;

            if($request->ajax()){
                return $this->user->get_user_data_by_user_tab($user->id, $request->tab);
            }
        }else{
            return redirect()->back();
        }

        return view('pim.employee.edit')->with($data);
    }


    public function getDataByTabAndId(Request $request){

        if($request->data_tab == 'education'){
            $data = EmployeeEducation::with('institute.educationLevel','degree')->find($request->data_id);
        }
        if($request->data_tab == 'experience'){
            $data = EmployeeExperience::find($request->data_id);
        }
        if($request->data_tab == 'nominee'){
            $data = EmployeeNominee::find($request->data_id);
        }
        if($request->data_tab == 'training'){
            $data = EmployeeTraining::find($request->data_id);
        }
        if($request->data_tab == 'reference'){
            $data = EmployeeReference::find($request->data_id);
        }
        if($request->data_tab == 'children'){
            $data = EmployeeChildren::find($request->data_id);
        }
        if($request->data_tab == 'language'){
            $data = EmployeeLanguage::find($request->data_id);
        }


        return response()->json($data);
    }



    /**
     * Update Employee Account with Basic Information
     * @param EmployeeBasicInfoRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editEmployee(EmployeeBasicInfoRequest $request){

        try{
            Artisan::call('db:connect');

            UserEmails::where('email',$request->email)->where('config_id',Session('config_id'))->update([
                'email' => $request->email,
            ]);

            Artisan::call("db:connect", ['database' => Session('database')]);
            DB::beginTransaction();

            if($request->hasFile('image')){
                $photo = time().'.'.$request->image->extension();
                if($request->image->storeAs($request->userId,$photo)){
                    if($request->has('old_image')) {
                        File::delete('files/'.$request->userId.'/'.$request->old_image);
                    }
                }else{
                    $request->session()->flash('warning','Photo Not Upload.Update photo form edit.');
                }
                $request->offsetSet('photo',$photo);
            }

            $request->offsetSet('updated_by',$this->auth->id);
            $user = User::find($request->userId);
            $user->update($request->all());

            $address = EmployeeAddress::findUser($request->userId);
            if($address){
                $address->update($request->all());
            }else{
               EmployeeAddress::create($request->all());
            }

            DB::commit();

            if($request->ajax()){
                $userData = $this->user->get_user_data_by_user_tab($request->userId, $request->tab);
                $data['data'] = $userData->original;
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('update_employee_and_next'))?'personal':null;
                $data['title'] = 'Success!';
                $data['message'] = 'Employee Successfully Update!';
                return response()->json($data,200);
            }

            $request->session()->flash('success','Employee Successfully Update!');

            if($request->has('update_next')){
                return redirect('/employee/edit/'.$request->userId.'/personal');
            }

            return redirect('/employee/edit/'.$request->userId);

        }catch(\Exception $e){
            DB::rollback();
            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['type'] = null;
                $data['title'] = 'Error!';
                $data['message'] = 'Employee Not Update!';
                return response()->json($data,500);
            }
            $request->session()->flash('danger','Employee Not Update!');
            return redirect()->back()->withInput();
        }
    }


    /**
     * @post Edit Employee Personal Info
     * @param EmployeePersonalInfoRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editPersonalInfo(EmployeePersonalInfoRequest $request){
        try {
            $request->offsetSet('updated_by',$this->auth->id);
            if($employeeDetails = EmployeeDetail::findUser($request->userId)){
                $employeeDetails->update($request->all());
            }else{
                $request->offsetSet('created_by',$this->auth->id);
                EmployeeDetail::create($request->all());
            }

            $data['data'] = User::with('details.bloodGroup')->find($request->userId);

            if($request->ajax()){
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_personal_and_next'))?'education':null;
                $data['title'] = 'Success!';
                $data['message'] = 'Personal Info Successfully Update.';
                return response()->json($data,200);
            }

            $request->session()->flash('success','Personal Info Successfully Update.');

            if($request->has('save_personal_and_next')){
                return redirect('/employee/edit/'.$request->userId.'/education');
            }
            return redirect('/employee/edit/'.$request->userId.'/personal');

        }catch (\Exception $e){
            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['type'] = null;
                $data['title'] = 'Error!';
                $data['message'] = 'Personal Info Not Update.';
                return response()->json($data,500);
            }

            $request->session()->flash('danger','Personal Info Not Update.');
            return redirect()->back()->withInput();
        }
    }


    /**
     * @post Edit Employee Salary
     * @param EmployeeSalaryRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function editSalary(EmployeeSalaryRequest $request){

        DB::beginTransaction();
        try{
            $request->offsetSet('updated_by', $this->auth->id);
            $request->offsetSet('user_id', $request->userId);

            User::where('id',$request->userId)->update([
                'basic_salary' => $request->basic_salary,
                'salary_in_cache' => $request->salary_in_cache,
                'effective_date' => $request->effective_date,
            ]);

            if($request->has('salary_info')){
                $salary_info = $request->salary_info;
//                dd($salary_info);
                $saveData = [];
                foreach($salary_info as $sinfo){
                    if(isset($sinfo['id'])) {
                        if(isset($sinfo['salary_id'])) {

                            $updateData = [
                                'user_id' => $request->userId,
                                'basic_salary_info_id' => $sinfo['id'],
                                'salary_amount' => $sinfo['amount'],
                                'salary_amount_type' => $sinfo['type'],
                                'salary_effective_date' => ($sinfo['effective_date']) ?: date('Y-m-d'),
                                'updated_by' => $this->auth->id,
                            ];

                            EmployeeSalary::where('id',$sinfo['salary_id'])->update($updateData);
                        }else{
                            $saveData[] = [
                                'user_id' => $request->userId,
                                'basic_salary_info_id' => $sinfo['id'],
                                'salary_amount' => $sinfo['amount'],
                                'salary_amount_type' => $sinfo['type'],
                                'salary_effective_date' => ($sinfo['effective_date']) ?: date('Y-m-d'),
                                'created_by' => $this->auth->id,
                                'created_at' => date('Y-m-d')
                            ];
                        }
                    }else{
                        if(isset($sinfo['salary_id'])) {
                            EmployeeSalary::where('id', $sinfo['salary_id'])->delete();
                        }
                    }
                }
                if(count($saveData)>0) {
//                    dd($saveData);
                    EmployeeSalary::insert($saveData);
                }
            }

            if($request->has('bank_id') && $request->has('bank_account_no')){
                if($request->salary_account_id && !empty($request->salary_account_id)) {
                    EmployeeSalaryAccount::find($request->salary_account_id)->update($request->all());
                }else{
                    EmployeeSalaryAccount::create($request->all());
                }
            }

            DB::commit();

            if($request->ajax()){
                $data['data'] = User::with('salaries.basicSalaryInfo','salaryAccount')->find($request->userId);
                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['type'] = ($request->has('save_salary_and_next'))?'nominee':null;
                $data['title'] = 'Success!';
                $data['message'] = 'Salary Successfully Update.';
                return response()->json($data,200);
            }

            $request->session()->flash('success','Salary Successfully Update.');

            if($request->has('save_salary_and_next')){
                return redirect('/employee/edit/'.$request->userId.'/nominee');
            }
            return redirect('/employee/edit/'.$request->userId.'/salary');

        }catch(\Exception $e){
            DB::rollback();

            if($request->ajax()){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['type'] = null;
                $data['title'] = 'Error!';
                $data['message'] = 'Salary Not Saved.';
                return response()->json($data,500);
            }

            $request->session()->flash('danger','Salary Not Update.');
            return redirect()->back()->withInput();
        }
    }


    /**
     * @Delete Employee Data
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteEmployeeData(Request $request){
        if($request->ajax()){
            try{
                if($request->segment(4) == 'education'){
                    EmployeeEducation::where('id',$request->id)->delete();
                }
                if($request->segment(4) == 'experience'){
                    EmployeeExperience::where('id',$request->id)->delete();
                }
                if($request->segment(4) == 'nominee'){
                    EmployeeNominee::where('id',$request->id)->delete();
                }
                if($request->segment(4) == 'training'){
                    EmployeeTraining::where('id',$request->id)->delete();
                }
                if($request->segment(4) == 'reference'){
                    EmployeeReference::where('id',$request->id)->delete();
                }
                if($request->segment(4) == 'children'){
                    EmployeeChildren::where('id',$request->id)->delete();
                }
                if($request->segment(4) == 'language'){
                    EmployeeLanguage::where('id',$request->id)->delete();
                }

                $data['status'] = 'success';
                $data['statusType'] = 'OK';
                $data['code'] = 200;
                $data['title'] = 'Success!';
                $data['message'] = ucfirst($request->segment(4)).' Successfully Deleted.';
                return response()->json($data,200);

            }catch(\Exception $e){
                $data['status'] = 'danger';
                $data['statusType'] = 'NotOk';
                $data['code'] = 500;
                $data['type'] = null;
                $data['title'] = 'Error!';
                $data['message'] = ucfirst($request->segment(4)).' Not Deleted.';
                return response()->json($data,500);
            }
        }
    }


    public function deleteEmployee($employee_id){
        return redirect()->back();
    }



}
