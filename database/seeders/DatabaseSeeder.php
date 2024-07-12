<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $userRecords = [
            ['id' => 1,
            'name' => 'Sagar Suryawanshi',
            'email' => 'sagarsuryawanshi191@gmail.com',
            'password' => Hash::make('Sagar@123'),],
            ['id' => 2,
            'name' => 'John Doe',
            'email' => 'john@doctor.com',
            'password' => Hash::make('123456'),],
            ['id' => 3,
            'name' => 'Mike Taylor',
            'email' => 'mike@patient.com',
            'password' => Hash::make('123456'),],
        ];

        User::insert($userRecords);

        $this->call(RoleSeeder::class);
    }
}
