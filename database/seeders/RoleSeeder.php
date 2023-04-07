<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $all_permissions = Permission::all();

        Role::create([
            'name' => 'Super Admin',
            'slug' => 'super-admin'
        ])->permissions()->sync($all_permissions->pluck('id')); //permission id passe

        Role::create([
            'name' => 'Admin',
            'slug' => 'admin'
        ])->permissions()->sync($all_permissions->pluck('id')); //permission id passe

        Role::create([
            'name' => 'Client',
            'slug' => 'client'
        ]);

    }
}
