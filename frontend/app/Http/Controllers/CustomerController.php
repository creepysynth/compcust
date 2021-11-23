<?php

namespace App\Http\Controllers;

use App\Http\Backend\Api;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the customers.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Backend\Api $api
     * @return \Illuminate\Contracts\View\Factory
     */
    public function index(Request $request, Api $api)
    {
        $customers = $api->get('customers', $request->all())->paginate(15);
        $columns = $this->tableHeadersAttributes($customers);

        return view('customers.index', compact(
            'customers',
            'columns'
        ));
    }

    /**
     * Show the form for creating a new customer.
     *
     * @return \Illuminate\Contracts\View\Factory
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Store a newly created customer in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Backend\Api $api
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, Api $api)
    {
        $customer = $api->post('customers', $request->all())->send()->object();

        return redirect(route('customers.show', $customer->id));
    }

    /**
     * Display the specified customer.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Backend\Api $api
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory
     */
    public function show(Request $request, Api $api, $id)
    {
        $customer = $api->get("customers/$id")->send()->object();
        $companies = $api->get("customers/$id/companies", $request->all())->paginate(15);
        $companiesColumns = $this->tableHeadersAttributes($companies);

        return view('customers.show', compact(
            'customer',
            'companies',
            'companiesColumns'
        ));
    }

    /**
     * Show the form for editing the specified customer.
     *
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory
     */
    public function edit(Api $api, $id)
    {
        $customer = $api->get("customers/$id")->send()->object();

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified customer in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Api $api, $id)
    {
        $api->put("customers/$id", $request->all())->send();

        return redirect(route('customers.show', $id))->with('message',
            "The customer was updated."
        );
    }

    /**
     * Remove the specified customer from storage.
     *
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Api $api, $id)
    {
        $api->delete("customers/$id")->send();

        return redirect(route('customers.index'))->with('message',
            "The customer ID: $id was deleted."
        );
    }

    /**
     * Show the form for creating a new customer of the company.
     *
     * @param \App\Http\Backend\Api $api
     * @param mixed $id
     * @return \Illuminate\Contracts\View\Factory
     */
    public function createAndAttachToCompanyCreate(Api $api, $id)
    {
        $company = $api->get("companies/$id")->send()->object();

        return view('companies.customers.create', compact('company'));
    }

    /**
     * Store a new customer of the company.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Backend\Api $api
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAndAttachToCompanyStore(Request $request, Api $api, $id)
    {
        $customer = $api->post("companies/$id/customers", $request->all())->send()->object();

        return redirect(route('customers.show', $customer->id));
    }

    /**
     * Display the list of customers that are to be bound to or unbound from company.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Backend\Api $api
     * @param int $id
     * @return \Illuminate\Contracts\View\Factory
     */
    public function createRelationsToCompanyCreate(Request $request, Api $api, $id)
    {
        $company =  $api->get("companies/$id")->send()->object();
        $customers = $api->get('customers', $request->all())->paginate(15);
        $relatedCustomersIDs = $api->get("companies/$id/customers/ids")->send()->object();
        $columns = $this->tableHeadersAttributes($customers);

        foreach ($customers as $customer) {
            $customer->related = in_array($customer->id, $relatedCustomersIDs);
        }

        return view('companies.customers.update',
            compact('company', 'customers', 'columns'));
    }

    /**
     * Update relations between company and customers.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Http\Backend\Api $api
     * @param mixed $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createRelationsToCompanyStore(Request $request, Api $api, $id)
    {
        $all = $request->input('ids', []);  // IDs of all customers on the page
        $checked = $request->input('checked', []);  // IDs of checked customers on the page
        $unchecked = array_diff($all, $checked);

        dd($api->put("companies/$id/customers", ['ids' => $checked])->object());

        if ($checked) {
            $api->put("companies/$id/customers", ['ids' => $checked])->send()->object();
        }

        if ($unchecked) {
            $api->delete("companies/$id/customers", ['ids' => $unchecked])->send();
        }

        return redirect(route('companies.show', $id))
                   ->with('message', "The company's list of customers was updated.");
    }
}
