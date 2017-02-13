<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

trait CommonService
{
    public function getDistrictByID($id){
        $result = DB::table('districts')->where('id',$id)->get();
        return $result;
    }
}
