<?php

namespace App\Services;

use App\Models\User;
use App\Models\Level;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrganogramService extends Controller
{

	protected $level;

	protected $supervisor;

	public function __construct($level=0, $supervisor=0){
		$this->level = $level;
		$this->supervisor = $supervisor;
	}


    public function organogram()
    {
    	$result = User::with('designation','childRecursive.designation')->where('status',1)->where(function($q){
    		$q->where('supervisor_id',$this->supervisor)->orWhere('supervisor_id','NULL');
    	})->get();

    	$result = $this->generateOrganogram($result, $index=0);
    	return $result[0];
    	dd($result);

    }


    protected function generateOrganogram($users, $index){
    	foreach($users as $user){

    		if(count($user->child)>0){
    			$orgData[$index] = [
    				'id' => $user->id,
    				'fullname' => $user->fullname,
    				'designation_name' => $user->designation->designation_name,
    				'image' => $user->fullimage
    			];
    			$orgData[$index]['children'] = $this->generateOrganogram($user->child, $index);
    		}else{
    			$orgData[$index] = [
    				'id' => $user->id,
    				'fullname' => $user->fullname,
    				'designation_name' => $user->designation->designation_name,
    				'image' => $user->fullimage
    			];
    		}
    		$index++;
    	}
    	return $orgData;
    }


    public function levelOrganogram(){
    	$result = Level::with('designation.user','childRecursive.designation.user')->where('parent_id',$this->level)->get();
    	// dd($result);
    	$organogram = $this->generateLevelOrganogram($result, $orgData = [], $index = 0);
    	return $organogram;
    }


    protected function generateLevelOrganogram($levels, $orgData, $lavel_index)
    {
    	foreach($levels as $level){
    		foreach($level->designation as $designation){
    			foreach($designation->user as $user){
    				if($level->parent_id != 0){
    					$orgData[$lavel_index]['children'][] = [
	    					'level_id' => $level->id,
	    					'level_name' => $level->level_name,
	    					'designation_name' => $designation->designation_name,
	    					'first_name' => $user->first_name,
	    					'last_name' => $user->last_name,
	    					'full_name' => $user->fullname,
	    					'image' => $user->photo,
	    					'full_image' => $user->fullimage,
	    				];
    				}else{
	    				$orgData[$lavel_index] = [
	    					'level_id' => $level->id,
	    					'level_name' => $level->level_name,
	    					'designation_name' => $designation->designation_name,
	    					'first_name' => $user->first_name,
	    					'last_name' => $user->last_name,
	    					'full_name' => $user->fullname,
	    					'image' => $user->photo,
	    					'full_image' => $user->fullimage,
	    				];
    				}
    			}
    		}

    		$orgData = $this->generateOrganogram($level->childRecursive, $orgData, $lavel_index);
			echo ++$lavel_index;
    		echo "----";
    		// echo $lavel_index--;
    	}

    	return $orgData;
    }





}
