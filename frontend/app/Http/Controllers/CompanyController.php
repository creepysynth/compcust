<?php

namespace App\Http\Controllers;

use App\Http\Backend\Api;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the companies.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Backend\Api $api
     * @return \Illuminate\Contracts\View\Factory
     */
    public function index(Request $request, Api $api)
    {
        $companies = $api->get('companies', $request->all())->paginate(15);
        $columns = $this->tableHeadersAttributes($companies);

        return view('companies.index', compact(
            'companies',
            'columns'
        ));
    }

    /**
     * Show the form for creating a new company.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created company in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Backend\Api $api
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Api $api)
    {
        $company = $api->post('companies', $request->all())->send()->object();

        return redirect(route('companies.show', $company->id));
    }

    /**
     * Display the specified company.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Backend\Api $api
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory
     */
    public function show(Request $request, Api $api, $id)
    {
        $company = $api->get("companies/$id")->send()->object();
        $customers = $api->get("companies/$id/customers", $request->all())->paginate(15);
        $customersColumns = $this->tableHeadersAttributes($customers);

        return view('companies.show', compact(
            'company',
            'customers',
            'customersColumns',
        ));
    }

    /**
     * Show the form for editing the specified company.
     *
     * @param \App\Http\Backend\Api $api
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory
     */
    public function edit(Api $api, $id)
    {
        $company = $api->get("companies/$id")->send()->object();

        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified company in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Api $api
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Api $api, $id)
    {
        $api->put("companies/$id", $request->all())->send();

        return redirect(route('companies.show', $id))->with('message', "The company was updated.");
    }

    /**
     * Remove the specified company from storage.
     *
     * @param \App\Http\Backend\Api $api
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Api $api, $id)
    {
        $api->delete("companies/$id")->send();

        return redirect(route('companies.index'))->with('message', "The company ID: $id was deleted.");
    }
}
