<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuoteController extends Controller
{
    public function index()
    {
        return Quote::with('materials', 'wages')->orderBy('id', 'desc')->paginate(5);
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
            'petrol_cost_per_litre' => $request['petrol_cost_per_litre'],
            'petrol_quantity' => $request['petrol_quantity'],
            'electricity_cost_per_unit' => $request['electricity_cost_per_unit'],
            'electricity_quantity' => $request['electricity_quantity'],
            'scope_of_work' => $request['scope_of_work'],
            'total_expenses' => $request['total_expenses'],
            'total_materials' => $request['total_materials'],
            'total_wages' => $request['total_wages'],
            'other_expenses' => $request['other_expenses'],
            'consumables' => $request['consumables'],
            'quote_total_excl' => $request['quote_total_excl'],
            'quote_tax' => $request['quote_tax'],
            'quote_total' => $request['quote_total'],
        ]);

        $quote = Quote::find($request['quote_id']);

        $quote->materials()->createMany($request['materials']);
        $quote->wages()->createMany($request['wages']);

        return;
    }

    public function show(Quote $quote)
    {
        return $quote->with('materials', 'wages')->where('id', '=', $quote->id)->get();
    }

    public function edit(Quote $quote)
    {
        //
    }

    public function update(Request $request, Quote $quote)
    {
        $quote->update([
            'customer' => $request['customer'],
            'petrol_cost_per_litre' => $request['petrol_cost_per_litre'],
            'petrol_quantity' => $request['petrol_quantity'],
            'electricity_cost_per_unit' => $request['electricity_cost_per_unit'],
            'electricity_quantity' => $request['electricity_quantity'],
            'scope_of_work' => $request['scope_of_work'],
            'total_expenses' => $request['total_expenses'],
            'total_materials' => $request['total_materials'],
            'total_wages' => $request['total_wages'],
            'other_expenses' => $request['other_expenses'],
            'consumables' => $request['consumables'],
            'quote_total_excl' => $request['quote_total_excl'],
            'quote_tax' => $request['quote_tax'],
            'quote_total' => $request['quote_total'],
        ]);

        $quote = Quote::find($quote->id);

        $quote->materials()->delete();
        $quote->wages()->delete();

        foreach ($request['materials'] as $material) {
            $quote->materials()->updateOrCreate(['quote_id' => $quote], $material);
        }
        foreach ($request['wages'] as $wages) {
            $quote->wages()->updateOrCreate(['quote_id' => $quote], $wages);
        }

        return $quote;
    }

    public function destroy(Quote $quote)
    {
        //
    }
}
