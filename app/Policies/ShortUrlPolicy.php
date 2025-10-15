<?php

namespace App\Policies;

use App\Models\ShortUrl;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ShortUrlPolicy
{
    /**
     * Determine whether the user can create short URLs.
     * New Requirement: Admin and Member CAN create short URLs. SuperAdmin CANNOT create short URLs.
     */
    public function create(User $user): bool
    {
        // Only Admin and Member roles are allowed to create short URLs.
        return $user->role === 'Admin' || $user->role === 'Member';
    }

    /**
     * Determine whether the user can view a specific short URL.
     * This method is generally used for 'viewing' a single record (e.g., viewing the details page).
     * The list filtering logic is primarily handled in the Controller using viewAny/scopes.
     *
     * New Requirement:
     * - Member can only see the list of all short urls created by themselves (i.e., they can view their own).
     * - Admin can only see the list of all short urls created in their own company (i.e., they can view any in their company).
     * - SuperAdmin can see the list of all short urls for every company (i.e., they can view any short URL).
     */
    public function view(User $user, ShortUrl $shortUrl): bool
    {
        // 1. SuperAdmin: Can view all short URLs globally.
        if ($user->role === 'SuperAdmin') {
            return true;
        }

        // 2. Admin: Can view any short URL created by members in their company.
        if ($user->role === 'Admin' && $user->company_id) {
            // Check if the URL's creator belongs to the Admin's company.
            return $user->company_id === optional($shortUrl->user)->company_id;
        }

        // 3. Member: Can only view their own short URLs.
        if ($user->role === 'Member') {
            return $user->id === $shortUrl->user_id;
        }

        // Default: Deny access.
        return false;
    }

    /**
     * Determine whether the user can view any short URLs (i.e., access the listing page).
     * Allowing access to the page; the Controller's query must enforce the filtering (scopes).
     */
    public function viewAny(User $user): bool
    {
        // Allow access to the listing page for authenticated users.
        return $user->exists;
    }
}