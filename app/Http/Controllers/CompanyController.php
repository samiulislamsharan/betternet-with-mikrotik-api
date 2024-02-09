<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Comment;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function edit()
    {
        if (!auth()->user()->isAdmin()) {
            redirect('/');
        }

        $company = Company::firstOrNew();
        return view('company.edit', compact('company'));
    }

    public function update(CompanyRequest $request)
    {
        $company = Company::firstOrNew();
        $company->fill($request->validated());
        $company->save();

        return back()->with('success', __('Update successful'));
    }
}
