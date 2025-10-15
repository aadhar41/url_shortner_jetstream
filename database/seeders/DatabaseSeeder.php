<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // Added for potential utility, although not strictly needed for this logic
use App\Models\User;
use App\Models\Company;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CompanySeeder::class,
            ShortUrlSeeder::class,
        ]);

        // Define non-SuperAdmin roles
        $memberRoles = ['Admin', 'Member'];
        // Get all existing Company IDs for assignment
        $companyIds = Company::pluck('id')->all();
        $randomCompanyId = $companyIds ? fake()->randomElement($companyIds) : null;

        // 1. Create a single SuperAdmin User
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'superadmin@example.com', // Explicit email for easy login/testing
            'role' => 'SuperAdmin',
            'company_id' => $randomCompanyId,
        ]);

        // 2. Create the remaining 9 users with Admin or Member roles
        User::factory(9)->create()->each(function ($user) use ($companyIds, $memberRoles) {
            $user->company_id = $companyIds ? fake()->randomElement($companyIds) : null;
            $user->role = fake()->randomElement($memberRoles);
            $user->save();
        });
    }
}
