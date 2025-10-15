<?php

namespace Database\Factories;

use App\Models\ShortUrl;
use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ShortUrlFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShortUrl::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ensure that Companies and Users exist before running this factory
        $companyId = Company::inRandomOrder()->value('id') ?? Company::factory()->create()->id;
        $userId = User::inRandomOrder()->value('id') ?? User::factory()->create()->id;

        return [
            'company_id' => $companyId,
            'user_id' => $userId,
            'original_url' => $this->faker->url(),
            // Generate a random short code for the factory
            'short_code' => Str::random(8),
            'is_active' => $this->faker->boolean(90), // 90% chance of being active
            'access_count' => $this->faker->numberBetween(0, 5000),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-6 months', 'now'),
        ];
    }

    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterMaking(function (ShortUrl $shortUrl) {
            // Ensure the short_code is unique if it wasn't explicitly set
            if (ShortUrl::where('short_code', $shortUrl->short_code)->exists()) {
                $shortUrl->short_code = ShortUrl::generateUniqueCode();
            }
        });
    }
}