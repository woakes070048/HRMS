<?php 
namespace App\Services;

use App\Models\Module;
use App\Models\Menu;
use App\Models\UserPermission;

use Auth;
use Illuminate\Support\Facades\Artisan;

trait PermissionService{

	public function hrmsSideBar()
    {
        $allMenus = Menu::where('menu_status', 1)->get();
		session(['menuShare' => $allMenus]);

		$allModules = Module::with('menus')->get();
		session(['moduleShare' => $allModules]);
    }

    public function userPermission($userId){

    	//$userModule = 
    }
}