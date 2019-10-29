<?php

namespace App\Http\Controllers;

use App\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index()
    {
        return Customer::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::table('customers')->insert([
            'customer' => $request['customer'],
            'colour' => $request['colour'],
            'vat_number' => $request['vat_number'],
            'company_number' => $request['company_number'],
        ]);

        return;
    }

    public function show(Customer $customer)
    {
        //
    }

    public function edit(Customer $customer)
    {
        //
    }

    public function update(Request $request, Customer $customer)
    {
        DB::table('customers')
            ->where('id', $customer->id)
            ->update([
                'customer' => $request->customer,
                'colour' => $request->colour,
                'vat_number' => $request->vat_number,
                'company_number' => $request->company_number,
            ]);
        return;
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return;
    }
}
