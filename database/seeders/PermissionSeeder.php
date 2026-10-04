<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            // Farmers
            [
                'name' => 'farmers.view',
                'display_name' => 'View Farmers',
                'module' => 'farmers',
            ],
            [
                'name' => 'farmers.create',
                'display_name' => 'Create Farmers',
                'module' => 'farmers',
            ],
            [
                'name' => 'farmers.update',
                'display_name' => 'Update Farmers',
                'module' => 'farmers',
            ],
            [
                'name' => 'farmers.delete',
                'display_name' => 'Delete Farmers',
                'module' => 'farmers',
            ],

            // Procurement
            [
                'name' => 'procurement.view',
                'display_name' => 'View Procurement',
                'module' => 'procurement',
            ],
            [
                'name' => 'procurement.create',
                'display_name' => 'Create Milk Collection',
                'module' => 'procurement',
            ],

            // Payments
            [
                'name' => 'payments.view',
                'display_name' => 'View Payments',
                'module' => 'payments',
            ],
            [
                'name' => 'payments.create',
                'display_name' => 'Create Payments',
                'module' => 'payments',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                [
                    'name' => $permission['name'],
                ],
                $permission
            );
        }
    }
}
