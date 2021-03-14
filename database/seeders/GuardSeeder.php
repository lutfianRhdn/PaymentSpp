<?php

namespace Database\Seeders;

use App\Models\Guard;
use App\Models\User;
use Illuminate\Database\Seeder;

class GuardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = \App\Models\User::whereHas('roles',function($q){
            $q->where('roles.name','guard');
        })->get();
        foreach ($users as $user ) {
            \App\Models\Guard::create(['user_id'=>$user->id]);
        }
    }
}
