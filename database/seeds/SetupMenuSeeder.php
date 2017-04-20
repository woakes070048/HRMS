<?php

use Illuminate\Database\Seeder;

class SetupMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            ['menu_parent_id'=>'0', 'module_id'=>'1',	'menu_name'=>'Transfer / Promotion', 'menu_url'=>'promotion/index', 'menu_section_name'=>'Transfer / Promotion', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'1',	'menu_name'=>'Employee', 'menu_url'=>'employee/index', 'menu_section_name'=>'Employee', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'2',	'menu_name'=>'Department', 'menu_url'=>'department/index', 'menu_section_name'=>'Department', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'2',	'menu_name'=>'Unit', 'menu_url'=>'unit/index', 'menu_section_name'=>'Unit', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'2',	'menu_name'=>'Levels', 'menu_url'=>'levels/index', 'menu_section_name'=>'Levels', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'2',	'menu_name'=>'Designation', 'menu_url'=>'designation/index', 'menu_section_name'=>'Designation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'2',	'menu_name'=>'Branch', 'menu_url'=>'branch/index', 'menu_section_name'=>'Branch', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'2',	'menu_name'=>'Bank', 'menu_url'=>'bank/index', 'menu_section_name'=>'Bank', 'menu_icon_class'=>'fa fa-money', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'3',	'menu_name'=>'Salary Info', 'menu_url'=>'salaryInfo/index', 'menu_section_name'=>'Salary Info', 'menu_icon_class'=>'glyphicon glyphicon-usd', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'4',	'menu_name'=>'Basic Settings', 'menu_url'=>'settings/index', 'menu_section_name'=>'Basic Settings', 'menu_icon_class'=>'glyphicons glyphicons-settings', 'menu_status'=>'1']
        ]);
    }
}
