<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import HasMany

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'company_id', // Assuming this exists for company relationship
        'role', // Used in navigation checks
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the companies owned by the user.
     *
     * @return HasMany
     */
    public function ownedCompanies(): HasMany
    {
        // The foreign key 'owner_user_id' is specified as it deviates from the default 'user_id'
        return $this->hasMany(Company::class, 'owner_user_id');
    }

    /**
     * Get the company that the user belongs to.
     */
    public function company(): BelongsTo
    {
        // This is necessary for the navigation menu logic.
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the short URLs created by the user.
     */
    public function shortUrls(): HasMany
    {
        // This fixes the Call to undefined method error.
        return $this->hasMany(ShortUrl::class, 'user_id');
    }

    /**
     * Get the total count of companies owned by this user.
     *
     * @return int
     */
    public function totalOwnedCompaniesCount(): int
    {
        // Use the relationship to get the count efficiently without loading all models
        return $this->ownedCompanies()->count();
    }
}