<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role as RoleModel;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name'=>'guard'],
            ['name'=>'student'],
            ['name'=>'admin'],
        ];
        foreach ($roles as $role ) {
            RoleModel::create($role);
        }
    }
}
