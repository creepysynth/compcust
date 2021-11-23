<?php

namespace App\Http\Controllers;

use App\Http\Validators\QueryValidator;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Return a listing of the customers
     *
     * @param \App\Http\Validators\QueryValidator $validator
     * @return \Illuminate\Http\Response
     */
    public function index(QueryValidator $validator)
    {
        $limit = $validator->limit();
        $offset = $validator->offset();
        $sort = $validator->sort(Customer::SORTABLE);
        $order = $validator->order();

        $customers = Customer::limit($limit)->offset($offset)
                         ->when($sort, function ($query, $sort) use($order) {
                             return $query->orderBy($sort, $order);
                         })
                         ->get();

        return response($customers)
                   ->header('X-Total-Count', Customer::count());
    }

    /**
     * Store a newly created customer
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|max:24'
        ]);

        $customer = Customer::create($data);

        return response($customer);
    }

    /**
     * Display the specified customer.
     *
     * @param int|string $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! $customer = Customer::find($id)) {
            return response(['message' => 'Customer not found.'], 404);
        }

        return response($customer);
    }

    /**
     * Update the specified customer in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int|string $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! $customer = Customer::find($id)) {
            return response(['message' => 'Customer not found.'], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|required|max:255',
            'email' => 'sometimes|required|email|unique:customers',
            'phone' => 'sometimes|required|max:24'
        ]);

        $customer->update($data);

        return response($customer);
    }

    /**
     * Remove the specified customer from storage.
     *
     * @param int|string $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! $customer = Customer::find($id)) {
            return response(['message' => 'Customer not found.'], 404);
        }

        $customer->delete();

        return response(['message' => 'Customer successfully deleted.']);
    }

    /**
     * Return a list of company's customers
     *
     * @param \App\Http\Validators\QueryValidator $validator
     * @param string|int $id
     * @return \Illuminate\Http\Response
     */
    public function relatedToCompany(QueryValidator $validator, $id) {
        if (! $company = Company::find($id)) {
            return response(['message' => 'Company not found.'], 404);
        }

        $limit = $validator->limit();
        $offset = $validator->offset();
        $sort = $validator->sort(Customer::SORTABLE);
        $order = $validator->order();

        $customers = $company->customers()->limit($limit)->offset($offset)
                         ->when($sort, function ($query, $sort) use($order) {
                             return $query->orderBy($sort, $order);
                         })
                         ->get();

        return response($customers)
                   ->header('X-Total-Count', $company->customers()->count());
    }

     /**
     * Return a list of IDs of all company's customers
     *
     * @param string|int $id
     * @return \Illuminate\Http\Response
     */
    public function relatedToCompanyGetIDs($id)
    {
        if (! $company = Company::find($id)) {
            return response(['message' => 'Company not found.'], 404);
        }

        return response($company->customers()
                           ->get(['customer_id'])
                           ->pluck('customer_id'));
    }

    public function createAndAttachToCompany(Request $request, $id)
    {
        if (! $company = Company::find($id)) {
            return response(['message' => 'Company not found.'], 404);
        }

        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|max:24'
        ]);

        $customer = $company->customers()->create($data);
        $customer['company_id'] = $company->id;

        return response($customer);
    }

    /**
     * Attach the customer(s) with provided ID(s) to the company.
     * Requires the list of customers IDs to be provided in a request
     *
     * @param \Illuminate\Http\Request $request
     * @param  string|int $id
     * @return \Illuminate\Http\Response
     */
    public function attachToCompany(Request $request, $id)
    {
        if (! $company = Company::find($id)) {
            return response(['message' => 'Company not found.'], 404);
        }

        $data = $request->validate([
            'ids'    => 'required|array|min:1',
            'ids.*'  => 'required|alpha_num|distinct|min:1',
        ]);

        $company->customers()->syncWithoutDetaching($data['ids']);

        return response(['message' => 'Customer(s) successfully bound to company.']);
    }

    /**
     * Detach the customer(s) with provided ID(s) from the company.
     * Requires the list of customers ids to be provided in a request
     *
     * @param \Illuminate\Http\Request $request
     * @param string|int $id
     * @return \Illuminate\Http\Response
     */
    public function detachFromCompany(Request $request, $id)
    {
        if (! $company = Company::find($id)) {
            return response(['message' => 'Company not found.'], 404);
        }

        $data = $request->validate([
            'ids'    => 'required|array|min:1',
            'ids.*'  => 'required|alpha_num|distinct|min:1',
        ]);

        $company->customers()->detach($data['ids']);

        return response(['message' => 'Customer(s) successfully unbound from company.']);
    }
}
