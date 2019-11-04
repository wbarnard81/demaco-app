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
        return Quote::latest()->first()->id;
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
        ]);

        $quoteId = DB::getPdo()->lastInsertId();
        DB::table('wages')->insert([
            'employee' => $request['employee'],
            'normal_hours' => $request['normal_hours'],
            'overtime_hours' => $request['overtime_hours'],
            'doubletime_hours' => $request['doubletime_hours'],
        ]);

        // $quoteId = DB::getPdo()->lastInsertId();
        // $quote = \App\Quote::find($quoteId);
        // $quote->materials()->attach($request['material']);

        $quote = \App\Quote::find($quoteId);
        $quote->wages()->attach($request['employees']);

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
