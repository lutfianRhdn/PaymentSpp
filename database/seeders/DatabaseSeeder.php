<?php

namespace Database\Seeders;

use Spatie\Permission\Models\Role;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Tuition::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            MajorSeeder::class,
            ClassSeeder::class,
            PermissionSeeder::class,
            SetPermissionToAllUser::class,
            ]);
        \App\Models\User::factory(20)->create()->each(function($user){
            $role= Role::all()->random();
            $user->assignRole($role->name);
        });
        $this->call(GuardSeeder::class);
        \App\Models\Student::factory(5)->create();
        \App\Models\Payment::factory(10)->create();
    }
}
