<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function index()
    {
        return Client::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::table('clients')->insert([
            'customer' => $request['customer'],
            'color' => $request['color'],
            'job' => $request['job'],
            'start_date' => date_create($request['start_date']),
            'deadline_date' => date_create($request['deadline_date']),
            'deadline_time' => $request['deadline_time'],
            'delivery_date' => date_create($request['delivery_date']),
            'boilermaker' => $request['boilermaker'],
        ]);

        return;
    }

    public function show(Client $client)
    {
        //
    }

    public function edit(Client $client)
    {
        //
    }

    public function update(Request $request, Client $client)
    {
        DB::table('clients')
            ->where('id', $client->id)
            ->update([
                'customer' => $request->customer,
                'color' => $request->color,
                'job' => $request->job,
                'start_date' => date_create($request->start_date),
                'deadline_date' => date_create($request->deadline_date),
                'deadline_time' => $request->deadline_time,
                'delivery_date' => date_create($request->delivery_date),
                'boilermaker' => $request->boilermaker
            ]);
        return;
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return;
    }
}
