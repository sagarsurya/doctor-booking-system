<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $rolePatient = Role::create(['name' => 'Patient']);
        $roleDoctor = Role::create(['name' => 'Doctor']);

        // Find users and assign roles
        $patientUser = User::where('email', 'mike@patient.com')->first();
        $doctorUser = User::where('email', 'john@doctor.com')->first();

        if ($patientUser) {
            $patientUser->assignRole('Patient');
        }

        if ($doctorUser) {
            $doctorUser->assignRole('Doctor');
        }
    }
}
