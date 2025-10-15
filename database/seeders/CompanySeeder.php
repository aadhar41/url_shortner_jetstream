<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userIds = \App\Models\User::pluck('id')->all();
        \App\Models\Company::factory()->count(10)->make()->each(function ($company) use ($userIds) {
            $company->owner_user_id = $userIds ? fake()->randomElement($userIds) : null;
            $company->save();
        });
    }
}