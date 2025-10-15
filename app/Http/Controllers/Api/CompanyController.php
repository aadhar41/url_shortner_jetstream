<?php

namespace App\Http\Controllers\Api;

use App\Models\Company;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

class CompanyController extends Controller
{
    // List all companies
    public function index()
    {
        return response()->json(Company::all());
    }

    // Show a single company
    public function show($id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }
        return response()->json($company);
    }

    // Create a new company
    public function store(StoreCompanyRequest $request)
    {
        $company = Company::create($request->validated());
        return response()->json($company, 201);
    }

    // Update a company
    public function update(UpdateCompanyRequest $request, $id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }
        $company->update($request->validated());
        return response()->json($company);
    }

    // Delete a company
    public function destroy($id)
    {
        $company = Company::find($id);
        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }
        $company->delete();
        return response()->json(['message' => 'Company deleted']);
    }
}
