<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Student::create([
            'user_id'=> $user = User::first(),
            'nis'=>rand(11111111,99999999),
            'phone'=> '0895384292459',
            'address'=>'indonesia'
        ]);
    }
}
