<?php

namespace App\Http\Controllers\Web;

use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CompanyWebController extends Controller
{
    // List all companies
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    // Show a single company
    public function show($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.show', compact('company'));
    }

    // Show create form
    public function create()
    {
        // Define the roles an Admin/SuperAdmin can assign.
        // 'SuperAdmin' role is intentionally excluded from being assigned via a form.
        $assignableRoles = ['Admin', 'Member'];

        // Pass the roles and the current user's role status to the view (optional, but good practice)
        return view('companies.create', [
            'assignableRoles' => $assignableRoles,
        ]);
    }

    // Store a new company AND register the first user
    public function store(StoreCompanyRequest $request)
    {
        // 1. Create the Company
        $company = Company::create($request->validated());

        // Determine the role for the new user
        $loggedInUser = auth()->user();
        $newUserRole = 'Member'; // Safe default

        if ($loggedInUser && $loggedInUser->role === 'SuperAdmin') {
            // SuperAdmin is creating: The new user is always an Admin.
            $newUserRole = 'Admin';
        } else {
            $newUserRole = $request->input('role', 'Admin');
        }

        // 2. Register the first User (Owner/Admin) for this new company
        User::create([
            'name' => $request->input('name') ?? 'Initial Admin',
            'email' => $request->input('email'),
            'password' => Hash::make($request->input('password')), // HASH the password for security
            'company_id' => $company->id, // Link the user to the new company
            'role' => $newUserRole, // Use the dynamically determined role
        ]);

        return redirect()->route('web.companies.index')->with('success', 'Company and initial Admin user created successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('companies.edit', compact('company'));
    }

    // Update a company
    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->validated());
        return redirect()->route('web.companies.index')->with('success', 'Company updated successfully.');
    }

    // Delete a company
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('web.companies.index')->with('success', 'Company deleted successfully.');
    }
}