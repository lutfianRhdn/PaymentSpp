<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus=[
            'payment','tuition','class','user'
        ];
        $permissions = [
            'index','create','update','delete'
        ];
        foreach ($menus as $menu) {
            foreach ($permissions as $permission ) {
                Permission::create([
                    'name'=>"{$menu}.{$permission}",
                    'guard_name'=>'web'
                ]);
            }
        }
    }
}
