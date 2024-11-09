<?php

namespace Database\Seeders;

use App\Enums\Roles\RolesEnums;
use App\Enums\Tools\AddressType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminEmail = config('try.admin.email');

        $superAdmin = [

            'name' => 'Elmarzougui Abdelghafour',
            'email' => $adminEmail,
            'email_verified_at' => now(),
            'password' => 'password',
            'remember_token' => Str::random(10),
            'role' => RolesEnums::SUPERADMIN,
        ];

        $admin = User::whereEmail($adminEmail)->first();

        if (! $admin) {
            $newAdmin = User::create($superAdmin);

            $newAdmin->assignRole(RolesEnums::SUPERADMIN);
        } else {

            $admin->assignRole(RolesEnums::SUPERADMIN);
        }
    }
}
