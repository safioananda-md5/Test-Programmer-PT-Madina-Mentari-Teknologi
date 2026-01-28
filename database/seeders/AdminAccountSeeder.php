<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $CountAdmin = User::where('role', 'admin')->get();

        if (count($CountAdmin) == 1) {
            User::where('role', 'admin')->update([
                'name' => 'Administration',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'phone' => '999999999999',
                'employee_start_date' => now(),
                'role' => 'admin',
            ]);
        } else {
            User::where('role', 'admin')->delete();
            User::create([
                'name' => 'Administration',
                'username' => 'admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('admin123'),
                'phone' => '999999999999',
                'employee_start_date' => now(),
                'role' => 'admin',
            ]);
        }
    }
}
