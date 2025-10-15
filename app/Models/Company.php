<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'owner_user_id',
        // Note: 'created_at' and 'updated_at' are usually handled by Laravel automatically
        // and do not need to be in $fillable unless you intend to manually assign them.
    ];

    /**
     * Get the user that owns the company (the owner).
     *
     * @return BelongsTo
     */
    public function owner(): BelongsTo
    {
        // Assumes the foreign key is 'owner_user_id' and the local key on the User model is 'id'
        return $this->belongsTo(User::class, 'owner_user_id');
    }
}