<?php

use Illuminate\Database\Seeder;
use App\Models\Setup\User;

class SetupUserCreateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facker = Faker\Factory::create();

        DB::table('users')->insert([
            'first_name' => $facker->firstName,
            'last_name' => $facker->lastName,
            'email' => $facker->email,
            'mobile_number' => "01783605360",
            'password' => bcrypt('123456'),
        ]);
    }
}
