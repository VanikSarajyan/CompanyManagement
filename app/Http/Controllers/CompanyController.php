<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCompany;
use App\Http\Requests\UpdateCompany;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(5);

        return view('company.index', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompany $request)
    {
        $validated = $request->validated(); 

        $fullFileName = $request->file('logo')->getClientOriginalName();
        $fileName = pathinfo($fullFileName, PATHINFO_FILENAME);
        $extension = $request->file('logo')->getClientOriginalExtension();
        $fileNameToStore = $fileName.'_'.time().'.'.$extension;

        $request->file('logo')->storeAs('public/logos', $fileNameToStore);

        Company::create(array_merge($validated, ['logo' => $fileNameToStore]));
        return redirect('/companies')->with('success', 'Company created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $employees = $company->employees()->paginate(5);
        return view('company.show', compact('company', 'employees'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompany $request, Company $company)
    {
        $validated = $request->validated();
        
        if(request('logo')){
            $fullFileName = $request->file('logo')->getClientOriginalName();
            $fileName = pathinfo($fullFileName, PATHINFO_FILENAME);
            $extension = $request->file('logo')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
    
            $request->file('logo')->storeAs('public/logos', $fileNameToStore);
            $logoArray = ['logo' => $fileNameToStore];
            unlink(public_path('storage/logos/'.$company->logo));
        }

        $company->update(array_merge($validated, $logoArray ?? []));

        return redirect('/companies')->with('success', 'Company updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        unlink(public_path('storage/logos/'.$company->logo));
        $company->delete();
        return redirect('/companies')->with('success', 'Company deleted successfully!');
    }
}
