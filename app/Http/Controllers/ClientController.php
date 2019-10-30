<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
            'delivery_date' => date_create($request['delivery_date']),
            'boilermaker' => $request['boilermaker'],
            'completed' => $request['completed'],
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
                'delivery_date' => date_create($request->delivery_date),
                'boilermaker' => $request->boilermaker,
                'completed' => $request->completed
            ]);
        return;
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return;
    }

    public function urgent()
    {
        return DB::table('clients')
            ->where('deadline_date', '<', Carbon::now())->get();
    }
}
