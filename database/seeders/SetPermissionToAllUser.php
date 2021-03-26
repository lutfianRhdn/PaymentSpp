<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class SetPermissionToAllUser extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::all();
        foreach ($roles as $role ) {
            if($role->name =='admin'){
                $role->givePermissionTo(Permission::all());
            }elseif ($role->name =='guard') {
                $role->givePermissionTo(['payment.create','payment.index']);
            }else{
                $role->givePermissionTo(['payment.index']);
            }
        }
    }
}
