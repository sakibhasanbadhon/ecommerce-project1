<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $super = Role::where('slug','super-admin')->first();
        User::create([
            'role_id'    => $super->id,
            'first_name' => 'Super',
            'last_name'  => 'Admin',
            'email'      => 'super@gmail.com',
            'password'   => Hash::make(12345678),
            'email_verified_at' => now(),
        ]);

        $admin = Role::where('slug','admin')->first();
        User::create([
            'role_id'    => $admin->id,
            'first_name' => 'Admin',
            'last_name'  => 'name',
            'email'      => 'admin@gmail.com',
            'password'   => Hash::make(12345678),
            'email_verified_at' => now(),
        ]);

        $client = Role::where('slug','client')->first();
        User::create([
            'role_id'    => $client->id,
            'first_name' => 'Client',
            'last_name'  => 'name',
            'email'      => 'client@gmail.com',
            'password'   => Hash::make(12345678)
        ]);
    }
}
