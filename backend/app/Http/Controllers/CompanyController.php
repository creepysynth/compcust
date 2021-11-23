<?php

namespace App\Http\Controllers;

use App\Http\Validators\QueryValidator;
use App\Models\Company;
use App\Models\Customer;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Return a listing of the companies.
     *
     * @param \App\Http\Validators\QueryValidator $validator
     * @return \Illuminate\Http\Response
     */
    public function index(QueryValidator $validator)
    {
        $limit = $validator->limit();
        $offset = $validator->offset();
        $sort = $validator->sort(Company::SORTABLE);
        $order = $validator->order();

        $companies = Company::limit($limit)->offset($offset)
                         ->when($sort, function ($query, $sort) use($order) {
                             return $query->orderBy($sort, $order);
                         })
                         ->get();

        return response($companies)
                   ->header('X-Total-Count', Company::count());
    }

    /**
     * Store a newly created company in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:63|unique:companies',
            'description' => 'nullable|max:16383',
            'address' => 'required|max:255',
            'phone' => 'required|max:24'
        ]);

        $company = Company::create($data);

        return response($company, 201);
    }

    /**
     * Display the specified company.
     *
     * @param string|int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! $company = Company::find($id)) {
            return response(['message' => 'Company not found.'], 404);
        }

        return response($company);
    }

    /**
     * Update the specified company in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string|int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|max:63|unique:companies',
            'description' => 'nullable|max:16383',
            'address' => 'sometimes|required|max:255',
            'phone' => 'sometimes|required|max:24'

        ]);

        if (! $company = Company::find($id)) {
            return response(['message' => 'Company not found.'], 404);
        }

        $company->update($data);

        return response($company);
    }

    /**
     * Remove the specified company from storage.
     *
     * @param  string|int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! $company = Company::find($id)) {
            return response(['message' => 'Company not found.'], 404);
        }

        $company->delete();

        return response(['message' => 'Company successfully deleted.']);
    }

    /**
     * Return a listing of the companies for specified customer.
     *
     * @param \App\Http\Validators\QueryValidator $validator
     * @param int|string $id
     * @return \Illuminate\Http\Response
     */
    public function relatedToCustomer(QueryValidator $validator, $id)
    {
        if (! $customer = Customer::find($id)) {
            return response(['message' => 'Customer not found.'], 404);
        }

        $limit = $validator->limit();
        $offset = $validator->offset();
        $sort = $validator->sort(Company::SORTABLE);
        $order = $validator->order();

        $companies = $customer->companies()->limit($limit)->offset($offset)
                         ->when($sort, function ($query, $sort) use($order) {
                             return $query->orderBy($sort, $order);
                         })
                         ->get();

        return response($companies)
                   ->header('X-Total-Count', $customer->companies()->count());
    }
}
