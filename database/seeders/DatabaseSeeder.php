<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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

        \App\Models\User::factory(10)->create()->each(function ($user) {
            $companyIds = \App\Models\Company::pluck('id')->all();
            $roles = ['SuperAdmin', 'Admin', 'Member'];
            $user->company_id = $companyIds ? fake()->randomElement($companyIds) : null;
            $user->role = fake()->randomElement($roles);
            $user->save();
        });
    }
}