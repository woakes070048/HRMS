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
            ['menu_parent_id'=>'0', 'module_id'=>'1',   'menu_name'=>'View', 'menu_url'=>'promotion/index', 'menu_section_name'=>'Transfer / Promotion', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'1',   'menu_name'=>'View', 'menu_url'=>'employee/index', 'menu_section_name'=>'Employee', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'2',   'menu_name'=>'View', 'menu_url'=>'department/index', 'menu_section_name'=>'Department', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'2',   'menu_name'=>'View', 'menu_url'=>'unit/index', 'menu_section_name'=>'Unit', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'2',   'menu_name'=>'View', 'menu_url'=>'levels/index', 'menu_section_name'=>'Levels', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'2',   'menu_name'=>'View', 'menu_url'=>'designation/index', 'menu_section_name'=>'Designation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'2',   'menu_name'=>'View', 'menu_url'=>'branch/index', 'menu_section_name'=>'Branch', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'2',   'menu_name'=>'View', 'menu_url'=>'bank/index', 'menu_section_name'=>'Bank', 'menu_icon_class'=>'fa fa-money', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'3',   'menu_name'=>'View', 'menu_url'=>'salaryInfo/index', 'menu_section_name'=>'Salary Info', 'menu_icon_class'=>'glyphicon glyphicon-usd', 'menu_status'=>'1'],
            ['menu_parent_id'=>'0', 'module_id'=>'4',   'menu_name'=>'View', 'menu_url'=>'settings/index', 'menu_section_name'=>'Basic Settings', 'menu_icon_class'=>'glyphicons glyphicons-settings', 'menu_status'=>'1'],
            ['menu_parent_id'=>'1', 'module_id'=>'1',   'menu_name'=>'Add', 'menu_url'=>'promotion/add', 'menu_section_name'=>'Transfer / Promotion', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'1', 'module_id'=>'1',   'menu_name'=>'Edit', 'menu_url'=>'promotion/edit', 'menu_section_name'=>'Transfer / Promotion', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'1', 'module_id'=>'1',	'menu_name'=>'Delete', 'menu_url'=>'promotion/delete', 'menu_section_name'=>'Transfer / Promotion', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'2', 'module_id'=>'1',   'menu_name'=>'Add', 'menu_url'=>'employee/add', 'menu_section_name'=>'Employee', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'2', 'module_id'=>'1',   'menu_name'=>'Edit', 'menu_url'=>'employee/edit', 'menu_section_name'=>'Employee', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'2', 'module_id'=>'1',	'menu_name'=>'Delete', 'menu_url'=>'employee/delete', 'menu_section_name'=>'Employee', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'3', 'module_id'=>'2',   'menu_name'=>'Add', 'menu_url'=>'department/add', 'menu_section_name'=>'Department', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'3', 'module_id'=>'2',   'menu_name'=>'Edit', 'menu_url'=>'department/edit', 'menu_section_name'=>'Department', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'3', 'module_id'=>'2',	'menu_name'=>'Delete', 'menu_url'=>'department/delete', 'menu_section_name'=>'Department', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'4', 'module_id'=>'2',   'menu_name'=>'Add', 'menu_url'=>'unit/add', 'menu_section_name'=>'Unit', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'4', 'module_id'=>'2',   'menu_name'=>'Edit', 'menu_url'=>'unit/edit', 'menu_section_name'=>'Unit', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'4', 'module_id'=>'2',	'menu_name'=>'Delete', 'menu_url'=>'unit/delete', 'menu_section_name'=>'Unit', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'5', 'module_id'=>'2',   'menu_name'=>'Add', 'menu_url'=>'levels/add', 'menu_section_name'=>'Levels', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'5', 'module_id'=>'2',   'menu_name'=>'Edit', 'menu_url'=>'levels/edit', 'menu_section_name'=>'Levels', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'5', 'module_id'=>'2',	'menu_name'=>'Delete', 'menu_url'=>'levels/delete', 'menu_section_name'=>'Levels', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'6', 'module_id'=>'2',   'menu_name'=>'Add', 'menu_url'=>'designation/add', 'menu_section_name'=>'Designation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'6', 'module_id'=>'2',   'menu_name'=>'Edit', 'menu_url'=>'designation/edit', 'menu_section_name'=>'Designation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'6', 'module_id'=>'2',	'menu_name'=>'Delete', 'menu_url'=>'designation/delete', 'menu_section_name'=>'Designation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'7', 'module_id'=>'2',   'menu_name'=>'Add', 'menu_url'=>'branch/add', 'menu_section_name'=>'Branch', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'7', 'module_id'=>'2',   'menu_name'=>'Edit', 'menu_url'=>'branch/edit', 'menu_section_name'=>'Branch', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'7', 'module_id'=>'2',	'menu_name'=>'Delete', 'menu_url'=>'branch/delete', 'menu_section_name'=>'Branch', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'8', 'module_id'=>'2',   'menu_name'=>'Add', 'menu_url'=>'bank/add', 'menu_section_name'=>'Bank', 'menu_icon_class'=>'fa fa-money', 'menu_status'=>'1'],
            ['menu_parent_id'=>'8', 'module_id'=>'2',   'menu_name'=>'Edit', 'menu_url'=>'bank/edit', 'menu_section_name'=>'Bank', 'menu_icon_class'=>'fa fa-money', 'menu_status'=>'1'],
            ['menu_parent_id'=>'8', 'module_id'=>'2',	'menu_name'=>'Delete', 'menu_url'=>'bank/delete', 'menu_section_name'=>'Bank', 'menu_icon_class'=>'fa fa-money', 'menu_status'=>'1'],            
            ['menu_parent_id'=>'9', 'module_id'=>'3',   'menu_name'=>'Add', 'menu_url'=>'salaryInfo/add', 'menu_section_name'=>'Salary Info', 'menu_icon_class'=>'glyphicon glyphicon-usd', 'menu_status'=>'1'],
            ['menu_parent_id'=>'9', 'module_id'=>'3',   'menu_name'=>'Edit', 'menu_url'=>'salaryInfo/edit', 'menu_section_name'=>'Salary Info', 'menu_icon_class'=>'glyphicon glyphicon-usd', 'menu_status'=>'1'],
            ['menu_parent_id'=>'9', 'module_id'=>'3',	'menu_name'=>'Delete', 'menu_url'=>'salaryInfo/delete', 'menu_section_name'=>'Salary Info', 'menu_icon_class'=>'glyphicon glyphicon-usd', 'menu_status'=>'1'],
            ['menu_parent_id'=>'10', 'module_id'=>'4',   'menu_name'=>'Add', 'menu_url'=>'settings/add', 'menu_section_name'=>'Basic Settings', 'menu_icon_class'=>'glyphicons glyphicons-settings', 'menu_status'=>'1'],
            ['menu_parent_id'=>'10', 'module_id'=>'4',   'menu_name'=>'Edit', 'menu_url'=>'settings/edit', 'menu_section_name'=>'Basic Settings', 'menu_icon_class'=>'glyphicons glyphicons-settings', 'menu_status'=>'1'],
            ['menu_parent_id'=>'10', 'module_id'=>'4',  'menu_name'=>'Delete', 'menu_url'=>'settings/delete', 'menu_section_name'=>'Basic Settings', 'menu_icon_class'=>'glyphicons glyphicons-settings', 'menu_status'=>'1'],

            ['menu_parent_id'=>'0', 'module_id'=>'5',  'menu_name'=>'index', 'menu_url'=>'workshift/index', 'menu_section_name'=>'Work Shift', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'11', 'module_id'=>'5',  'menu_name'=>'add', 'menu_url'=>'workshift/add', 'menu_section_name'=>'Work Shift', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'11', 'module_id'=>'5',  'menu_name'=>'edit', 'menu_url'=>'workshift/edit', 'menu_section_name'=>'Work Shift', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'11', 'module_id'=>'5',  'menu_name'=>'delete', 'menu_url'=>'workshift/delete', 'menu_section_name'=>'Work Shift', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],

            ['menu_parent_id'=>'0', 'module_id'=>'5',  'menu_name'=>'index', 'menu_url'=>'shiftassign/index', 'menu_section_name'=>'Work Shift Assign', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'12', 'module_id'=>'5',  'menu_name'=>'assign', 'menu_url'=>'shiftassign/assign', 'menu_section_name'=>'Work Shift Assign', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],

            ['menu_parent_id'=>'0', 'module_id'=>'5',  'menu_name'=>'index', 'menu_url'=>'attendance/index', 'menu_section_name'=>'Attendance', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'13', 'module_id'=>'5',  'menu_name'=>'view', 'menu_url'=>'attendance/view', 'menu_section_name'=>'My Attendance', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
        ]);
    }
}
