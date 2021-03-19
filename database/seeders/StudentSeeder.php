<?php

namespace Database\Seeders;

use App\Models\Student;
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
            'user_id'=> User::whereHas('roles',function($q){return $q->where('name','student');})->first()->id,
            'nis'=>rand(11111111,99999999),
            'phone'=> '0895384292459',
            'address'=>'indonesia'
        ]);
    }
}
