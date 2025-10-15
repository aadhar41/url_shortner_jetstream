<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company; // Assuming users are associated with companies
use App\Http\Requests\StoreUserRequest; // Placeholder request for validation
use App\Http\Requests\UpdateUserRequest; // Placeholder request for validation
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserWebController extends Controller
{
    /**
     * Display a listing of the resource (all users).
     */
    public function index()
    {
        // In a production app, this should be paginated and filtered.
        // $users = User::with('company')->get();
        $users = auth()->user()->companyMembers()->where('id', '!=', auth()->id())->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource (user).
     */
    public function create()
    {
        // Define all available roles and companies to populate dropdowns
        $availableRoles = ['Admin', 'Member']; // Exclude 'SuperAdmin' from creation form
        $companies = Company::all(['id', 'name']);

        return view('users.create', compact('availableRoles', 'companies'));
    }

    /**
     * Store a newly created resource (user) in storage.
     * Note: Requires 'StoreUserRequest' to be created with validation rules.
     */
    public function store(StoreUserRequest $request)
    {
        $validated = $request->validated();

        // Hash the password before storing
        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route('web.users.index')->with('success', 'User created successfully.');
    }

    /**
     * Display the specified resource (user).
     */
    public function show($id)
    {
        $user = User::with('company')->findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource (user).
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $availableRoles = ['Admin', 'Member'];
        $companies = Company::all(['id', 'name']);

        return view('users.edit', compact('user', 'availableRoles', 'companies'));
    }

    /**
     * Update the specified resource (user) in storage.
     * Note: Requires 'UpdateUserRequest' to be created with validation rules.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();

        // Only update password if a new one is provided
        if (isset($validated['password']) && !empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('web.users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource (user) from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('web.users.index')->with('success', 'User deleted successfully.');
    }
}
