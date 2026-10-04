<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            [
                'name' => 'super_admin',
                'display_name' => 'Super Administrator',
            ],
            [
                'name' => 'union_admin',
                'display_name' => 'Union Administrator',
            ],
            [
                'name' => 'society_manager',
                'display_name' => 'Society Manager',
            ],
            [
                'name' => 'collection_operator',
                'display_name' => 'Collection Operator',
            ],
            [
                'name' => 'accountant',
                'display_name' => 'Accountant',
            ],
            [
                'name' => 'farmer',
                'display_name' => 'Farmer',
            ],
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate(
                [
                    'name' => $role['name'],
                ],
                $role
            );
        }
    }
}
