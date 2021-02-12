<?php

namespace Database\Seeders;

use App\Models\Designation;
use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Designation::insert([
            ['designation_name' => 'Managing Director'],
            ['designation_name' => 'General Manager'],
            ['designation_name' => 'Manager'],
            ['designation_name' => 'PM'],
            ['designation_name' => 'Developer'],
            ['designation_name' => 'Designer'],
            ['designation_name' => 'Worker'],
        ]);
    }
}
