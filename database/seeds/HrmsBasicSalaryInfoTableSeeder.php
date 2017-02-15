<?php

use Illuminate\Database\Seeder;

class HrmsBasicSalaryInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('basic_salary_info')->insert([
    		['name' => 'House Rent', 'amount' => '30', 'amount_status' => 0],
    		['name' => 'Food Allowance', 'amount' => '20', 'amount_status' => 0],
            ['name' => 'Transport', 'amount' => '10', 'amount_status' => 0],
            ['name' => 'Mobile Allowance', 'amount' => '5', 'amount_status' => 0],
            ['name' => 'Provident Fund', 'amount' => '2', 'amount_status' => 0],
            ['name' => 'Tax', 'amount' => '23', 'amount_status' => 0]
    	]);
    }
}
