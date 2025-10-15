<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany; // Import HasMany

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name', 'email', 'owner_user_id', 'created_at', 'updated_at'
    ];

    /**
     * Get the user that owns the company (the owner).
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_user_id');
    }

    /**
     * Get the users/members belonging to the company.
     * * NOTE: This assumes a 'company_id' column exists on the 'users' table.
     *
     * @return HasMany
     */
    public function members(): HasMany
    {
        return $this->hasMany(User::class, 'company_id');
    }

    /**
     * Get the total count of members in this company.
     *
     * @return int
     */
    public function totalMemberCount(): int
    {
        return $this->members()->count();
    }
}
