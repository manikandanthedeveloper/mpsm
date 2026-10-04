<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
        ]);

        $adminRole = Role::where(
            'name',
            'super_admin'
        )->first();

        $admin = User::updateOrCreate(
            [
                'email' => 'admin@milkunion.test',
            ],
            [
                'name' => 'System Administrator',
                'phone' => '9999999999',
                'password' => Hash::make('Password@123'),
                'status' => 'active',
            ]
        );

        $admin->roles()->syncWithoutDetaching([
            $adminRole->id,
        ]);
    }
}
