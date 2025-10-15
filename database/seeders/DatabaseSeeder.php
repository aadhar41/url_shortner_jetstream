<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
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

        // 1. Create all 10 users first. This is necessary to generate the user IDs
        // that will be used for the 'client_id' foreign key assignment.
        $users = User::factory(10)->create();
        $userIds = $users->pluck('id')->all();

        // Loop over all created users to set specific properties (role, company_id, and client_id)
        $users->each(function ($user, $key) use ($userIds, $companyIds, $memberRoles) {

            // The first user created (key 0) will be designated as the SuperAdmin.
            $isSuperAdmin = $key === 0;
            $userCompanyId = $companyIds ? fake()->randomElement($companyIds) : null;

            // Set the user's primary company and role
            $user->company_id = $userCompanyId;
            $user->role = $isSuperAdmin ? 'SuperAdmin' : fake()->randomElement($memberRoles);

            // Set fixed credentials for the SuperAdmin for easy testing
            if ($isSuperAdmin) {
                $user->name = 'Super Admin';
                $user->email = 'superadmin@example.com';
            }

            // --- Assignment of client_id (User ID) ---
            // The client_id is now another user's ID (or null), as requested.
            // Create the pool of potential client user IDs: all user IDs, excluding the current user, plus null.
            $clientPool = array_merge([null], array_diff($userIds, [$user->id]));

            // Assign a random user ID from the pool as the client_id
            $user->client_id = fake()->randomElement($clientPool);

            $user->save();
        });
    }
}
