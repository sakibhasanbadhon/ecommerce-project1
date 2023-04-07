<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    //Superadmin Admin ke je sob permission dite parbe

    public function run()
    {
        $moduleDashboard = Module::updateOrCreate(['name'=>'Dashboard Manage'],['name'=>'Dashboard Manage']);
        Permission::create([
            'module_id' => $moduleDashboard->id,
            'name'        => 'Dashboard Access',
            'slug'        => 'app.dashboard'
         ]);







        $moduleRole = Module::updateOrCreate(['name'=>'Role Manage'],['name'=>'Role Manage']);
        Permission::create([
            'module_id' => $moduleRole->id,
            'name'        => 'Role Access',
            'slug'        => 'app.roles.index'
         ]);

        Permission::create([
            'module_id' => $moduleRole->id,
            'name'        => 'Role Create',
            'slug'        => 'app.roles.create'
         ]);

        Permission::create([
            'module_id' => $moduleRole->id,
            'name'        => 'Role Edit',
            'slug'        => 'app.roles.edit'
         ]);

        Permission::create([
            'module_id' => $moduleRole->id,
            'name'        => 'Role Delete',
            'slug'        => 'app.roles.destroy'
         ]);


        $moduleUser = Module::updateOrCreate(['name'=>'User Manage'],['name'=>'User Manage']);
        Permission::create([
            'module_id' => $moduleUser->id,
            'name'        => 'User Access',
            'slug'        => 'app.users.index'
         ]);

        Permission::create([
            'module_id' => $moduleUser->id,
            'name'        => 'User Create',
            'slug'        => 'app.users.create'
         ]);

        Permission::create([
            'module_id' => $moduleUser->id,
            'name'        => 'User Edit',
            'slug'        => 'app.users.edit'
         ]);

        Permission::create([
            'module_id' => $moduleUser->id,
            'name'        => 'User Delete',
            'slug'        => 'app.users.destroy'
         ]);



    }
}
