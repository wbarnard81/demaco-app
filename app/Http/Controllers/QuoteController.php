<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuoteController extends Controller
{
    public function index()
    {
        return Quote::all();
    }

    public function jcNo()
    {
        return Quote::latest()->first();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::table('quotes')->insert([
            'customer' => $request['customer'],
            'petrol_quantity' => $request['petrol_quantity'],
            'electricity_quantity' => $request['electricity_quantity'],
            'sow' => $request['sow'],
            'other_expenses' => $request['other_expenses'],
            'consumables' => $request['consumables'],
            'quote_total' => $request['quote_total'],
        ]);

        $quoteId = DB::getPdo()->lastInsertId();

        $quote = \App\Quote::find($quoteId);
        $quote->wages()->attach($request['employee_wages']);
        $quote->materials()->attach($request['materials']);

        return $quote;
    }

    public function show(Quote $quote)
    {
        //
    }

    public function edit(Quote $quote)
    {
        //
    }

    public function update(Request $request, Quote $quote)
    {
        //
    }

    public function destroy(Quote $quote)
    {
        //
    }
}
