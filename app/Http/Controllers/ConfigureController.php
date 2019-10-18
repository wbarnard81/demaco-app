<?php

namespace App\Http\Controllers;

use App\Configure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigureController extends Controller
{
    public function index()
    {
        return Configure::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::table('configures')->insert([
            'fuel' => $request['fuel'],
            'electricity' => $request['electricity'],
            'provident_fund' => $request['provident_fund'],
        ]);

        return;
    }

    public function show(Configure $configure)
    {
        //
    }

    public function edit(Configure $configure)
    {
        //
    }

    public function update(Request $request, Configure $config)
    {
        DB::table('configures')
            ->where('id', $config->id)
            ->update([
                'fuel' => $request->fuel,
                'electricity' => $request->electricity,
                'provident_fund' => $request->provident_fund,
            ]);
        return;
    }

    public function destroy(Configure $configure)
    {
        $configure->delete();
        return;
    }
}
