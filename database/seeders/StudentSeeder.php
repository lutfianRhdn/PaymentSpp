<?php

namespace Database\Seeders;

use App\Models\Classes;
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
        $user =User::whereHas('roles',function($q){return $q->where('name','student');})->first();
        Student::create([
            'user_id'=> $user->id,
            'nis'=>rand(11111111,99999999),
            'phone'=> '0895384292459',
            'address'=>'indonesia',
            'class_id'=> Classes::all()->random()->first()->id
        ]);
    }
}
