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

            ['menu_parent_id'=>'0', 'module_id'=>'3',  'menu_name'=>'view', 'menu_url'=>'bonus/index', 'menu_section_name'=>'Bonus', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'17', 'module_id'=>'3',  'menu_name'=>'Add', 'menu_url'=>'bonus/add', 'menu_section_name'=>'Bonus', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'17', 'module_id'=>'3',  'menu_name'=>'Edit', 'menu_url'=>'bonus/edit', 'menu_section_name'=>'Bonus', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'17', 'module_id'=>'3',  'menu_name'=>'Delete', 'menu_url'=>'bonus/delete', 'menu_section_name'=>'Bonus', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
              
            ['menu_parent_id'=>'0', 'module_id'=>'3',  'menu_name'=>'view', 'menu_url'=>'increment/index', 'menu_section_name'=>'Increment', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'22', 'module_id'=>'3',  'menu_name'=>'Add', 'menu_url'=>'increment/add', 'menu_section_name'=>'Increment', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'22', 'module_id'=>'3',  'menu_name'=>'edit', 'menu_url'=>'increment/edit', 'menu_section_name'=>'Increment', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'22', 'module_id'=>'3',  'menu_name'=>'delete', 'menu_url'=>'increment/delete', 'menu_section_name'=>'Increment', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],

            ['menu_parent_id'=>'0', 'module_id'=>'3',  'menu_name'=>'view', 'menu_url'=>'loan/index', 'menu_section_name'=>'Loan', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'26', 'module_id'=>'3',  'menu_name'=>'add', 'menu_url'=>'loan/add', 'menu_section_name'=>'Loan', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'26', 'module_id'=>'3',  'menu_name'=>'edit', 'menu_url'=>'loan/edit', 'menu_section_name'=>'Loan', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'26', 'module_id'=>'3',  'menu_name'=>'delete', 'menu_url'=>'loan/delete', 'menu_section_name'=>'Loan', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            
            ['menu_parent_id'=>'0', 'module_id'=>'2',  'menu_name'=>'view', 'menu_url'=>'bonustype/index', 'menu_section_name'=>'Bonus Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'31', 'module_id'=>'2',  'menu_name'=>'add', 'menu_url'=>'bonustype/add', 'menu_section_name'=>'Bonus Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'31', 'module_id'=>'2',  'menu_name'=>'edit', 'menu_url'=>'bonustype/edit', 'menu_section_name'=>'Bonus Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'31', 'module_id'=>'2',  'menu_name'=>'delete', 'menu_url'=>'bonustype/delete', 'menu_section_name'=>'Bonus Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],

            ['menu_parent_id'=>'0', 'module_id'=>'2',  'menu_name'=>'view', 'menu_url'=>'incrementtype/index', 'menu_section_name'=>'Increment Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'35', 'module_id'=>'2',  'menu_name'=>'add', 'menu_url'=>'incrementtype/add', 'menu_section_name'=>'Increment Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'35', 'module_id'=>'2',  'menu_name'=>'edit', 'menu_url'=>'incrementtype/edit', 'menu_section_name'=>'Increment Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'35', 'module_id'=>'2',  'menu_name'=>'delete', 'menu_url'=>'incrementtype/delete', 'menu_section_name'=>'Increment Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],

            ['menu_parent_id'=>'0', 'module_id'=>'2',  'menu_name'=>'view', 'menu_url'=>'loantype/index', 'menu_section_name'=>'Lone Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'40', 'module_id'=>'2',  'menu_name'=>'add', 'menu_url'=>'loantype/add', 'menu_section_name'=>'Lone Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'40', 'module_id'=>'2',  'menu_name'=>'edit', 'menu_url'=>'loantype/edit', 'menu_section_name'=>'Lone Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'40', 'module_id'=>'2',  'menu_name'=>'delete', 'menu_url'=>'loantype/delete', 'menu_section_name'=>'Lone Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],

            ['menu_parent_id'=>'0', 'module_id'=>'2',  'menu_name'=>'view', 'menu_url'=>'claimtype/index', 'menu_section_name'=>'Claim Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'44', 'module_id'=>'2',  'menu_name'=>'add', 'menu_url'=>'claimtype/add', 'menu_section_name'=>'Claim Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'44', 'module_id'=>'2',  'menu_name'=>'edit', 'menu_url'=>'claimtype/edit', 'menu_section_name'=>'Claim Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'44', 'module_id'=>'2',  'menu_name'=>'delete', 'menu_url'=>'claimtype/delete', 'menu_section_name'=>'Claim Type', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],

            ['menu_parent_id'=>'0', 'module_id'=>'3',  'menu_name'=>'view', 'menu_url'=>'taxcalculation/index', 'menu_section_name'=>'Tax Calculation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'48', 'module_id'=>'3',  'menu_name'=>'add', 'menu_url'=>'taxcalculation/add', 'menu_section_name'=>'Tax Calculation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'48', 'module_id'=>'3',  'menu_name'=>'edit', 'menu_url'=>'taxcalculation/edit', 'menu_section_name'=>'Tax Calculation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'48', 'module_id'=>'3',  'menu_name'=>'delete', 'menu_url'=>'taxcalculation/delete', 'menu_section_name'=>'Tax Calculation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],

            ['menu_parent_id'=>'0', 'module_id'=>'3',  'menu_name'=>'view', 'menu_url'=>'providentfund/index', 'menu_section_name'=>'PF Calculation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'52', 'module_id'=>'3',  'menu_name'=>'add', 'menu_url'=>'providentfund/add', 'menu_section_name'=>'PF Calculation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'52', 'module_id'=>'3',  'menu_name'=>'edit', 'menu_url'=>'providentfund/edit', 'menu_section_name'=>'PF Calculation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'52', 'module_id'=>'3',  'menu_name'=>'delete', 'menu_url'=>'providentfund/delete', 'menu_section_name'=>'PF Calculation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],

            ['menu_parent_id'=>'0', 'module_id'=>'3',  'menu_name'=>'view', 'menu_url'=>'providentfund/index', 'menu_section_name'=>'PF Calculation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'56', 'module_id'=>'3',  'menu_name'=>'add', 'menu_url'=>'providentfund/add', 'menu_section_name'=>'PF Calculation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'56', 'module_id'=>'3',  'menu_name'=>'edit', 'menu_url'=>'providentfund/edit', 'menu_section_name'=>'PF Calculation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'56', 'module_id'=>'3',  'menu_name'=>'delete', 'menu_url'=>'providentfund/delete', 'menu_section_name'=>'PF Calculation', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],

            ['menu_parent_id'=>'0', 'module_id'=>'3',  'menu_name'=>'view', 'menu_url'=>'claim/index', 'menu_section_name'=>'Claim', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'60', 'module_id'=>'3',  'menu_name'=>'add', 'menu_url'=>'claim/add', 'menu_section_name'=>'Claim', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'60', 'module_id'=>'3',  'menu_name'=>'edit', 'menu_url'=>'claim/edit', 'menu_section_name'=>'Claim', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'60', 'module_id'=>'3',  'menu_name'=>'delete', 'menu_url'=>'claim/delete', 'menu_section_name'=>'Claim', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],

            ['menu_parent_id'=>'0', 'module_id'=>'3',  'menu_name'=>'view', 'menu_url'=>'payroll/index', 'menu_section_name'=>'Process payroll', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'64', 'module_id'=>'3',  'menu_name'=>'add', 'menu_url'=>'payroll/add', 'menu_section_name'=>'Process payroll', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'64', 'module_id'=>'3',  'menu_name'=>'edit', 'menu_url'=>'payroll/edit', 'menu_section_name'=>'Process payroll', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
            ['menu_parent_id'=>'64', 'module_id'=>'3',  'menu_name'=>'delete', 'menu_url'=>'payroll/delete', 'menu_section_name'=>'Process payroll', 'menu_icon_class'=>'fa fa-level-up', 'menu_status'=>'1'],
        ]);
    }
}
