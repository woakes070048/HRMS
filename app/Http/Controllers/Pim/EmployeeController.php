<?php

namespace App\Http\Controllers\Pim;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:hrms');
    }


    public function index(){
        return view('pim.employee.index');
    }

    public function add(){
        return view('pim.employee.add');
    }




}
