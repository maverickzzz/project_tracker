<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use App\Models\UserUsergroupCompany;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data = Company::where('id', '>', 0);

        $filter = $request->query();
        if (isset($filter['search'])) {
            $data
                ->where(function ($query) use ($filter) {
                    $query->where('code', 'like', '%' . $filter['search'] . '%')
                        ->orWhere('name', 'like', '%' . $filter['search'] . '%');
                });
        }

        return Inertia::render(
            'Dashboard/Companies/List',
            [
                'data' => $data->paginate(10)->withQueryString()
            ]
        );
    }

    public function create()
    {
        return Inertia::render(
            'Dashboard/Companies/Create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Company::create($data);
        return redirect(session('origin'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        return Inertia::render(
            'Dashboard/Companies/Edit',
            [
                'data' => $company
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        Company::where('id', $company->id)->update($request->all());
        return redirect(session('origin'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();
        return redirect(session('origin'));
    }

    public function select_company()
    {
        $companies = Company::get();

        if ($companies->count() === 1){
            session()->put('company_id', $companies[0]->id);
            session()->put('company_name', $companies[0]->name);
            session()->put('usergroup_id', UserUsergroupCompany::where('user_id', auth()->user()->id)->where('company_id', session('company_id'))->first()->usergroup_id ?? 0);
            session()->put('is_administrator', auth()->user() && auth()->user()->id === 1);

            return redirect('/');
        }

        return Inertia::render('Dashboard/Administration/SelectCompany',[
            'data' => $companies
        ]);
    }
}
