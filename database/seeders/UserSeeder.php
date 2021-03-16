<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // admin
        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('admin123'),
            'remember_token' => Str::random(10),
        ]);
        $admin->assignRole('admin');
        $student = User::create([
            'name' => 'student',
            'email' => 'student@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('student123'),
            'remember_token' => Str::random(10),
        ]);
        $student->assignRole('student');
        $guard = User::create([
            'name' => '13 officer test',
            'email' => 'officer@admin.com',
            'email_verified_at' => now(),
            'password' => Hash::make('officer123'),
            'remember_token' => Str::random(10),
        ]);
        $guard->assignRole('guard');
    }
}
