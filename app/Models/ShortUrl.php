<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShortUrl extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'short_urls';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'user_id',
        'original_url',
        'short_code',
        'is_active',
        'access_count',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'is_active' => 'boolean',
        'access_count' => 'integer',
    ];

    // --- Relationships ---

    /**
     * Get the company that owns the ShortUrl.
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the user who created the ShortUrl.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // --- Utility Methods ---

    /**
     * Generates a unique short code.
     *
     * @param int $length
     * @return string
     */
    public static function generateUniqueCode(int $length = 8): string
    {
        do {
            $code = Str::random($length);
        } while (self::where('short_code', $code)->exists());

        return $code;
    }

    /**
     * Generates a unique, random short code.
     *
     * @param int $length The desired length of the short code.
     * @return string
     */
    public static function generateUniqueShortCode(int $length = 6): string
    {
        // 1. Generate a random string of the specified length
        $code = Str::random($length);

        // 2. Check if this code already exists in the database
        $exists = self::where('short_code', $code)->exists();

        // 3. If the code exists, recursively call the function again (with a slightly longer length if needed)
        if ($exists) {
            // Optional: If we retry too many times, maybe increase the length to reduce collisions
            return self::generateUniqueShortCode($length);
        }

        // 4. If the code is unique, return it
        return $code;
    }
}
