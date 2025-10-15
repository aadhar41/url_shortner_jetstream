<?php

namespace App\Http\Controllers\Web;

use App\Models\Company;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;

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
        return view('companies.create');
    }

    // Store a new company
    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->validated());
        return redirect()->route('web.companies.index')->with('success', 'Company created successfully.');
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
