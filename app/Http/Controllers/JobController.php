<?php

namespace App\Http\Controllers;

use App\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class JobController extends Controller
{
    public function index()
    {
        $jobs = \App\Job::all();
        $employees = $jobs->employees;
        dd($employees);
        // dd(\App\Job::all()->employees);
        // $tags = $item->Tags;
        return Job::all();
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        DB::table('jobs')->insert([
            'customer' => $request['customer'],
            'color' => $request['color'],
            'description' => $request['description'],
            'start_date' => date_create($request['start_date']),
            'deadline_date' => date_create($request['deadline_date']),
            'delivery_date' => date_create($request['delivery_date']),
            'completed' => $request['completed'],
        ]);

        $jobId = DB::getPdo()->lastInsertId();

        //$job = \App\Job::where('customer', '=', $request['customer'])->first();
        //$jobId->employees()->sync($request['boilermaker']);

        $job = \App\Job::find($jobId);

        $job->employees()->attach($request['boilermaker']);    

        return $job;
    }

    public function show(Job $job)
    {
        //
    }

    public function edit(Job $job)
    {
        //
    }

    public function update(Request $request, Job $job)
    {
        DB::table('Jobs')
            ->where('id', $job->id)
            ->update([
                'customer' => $request->customer,
                'color' => $request->color,
                'description' => $request->description,
                'start_date' => date_create($request->start_date),
                'deadline_date' => date_create($request->deadline_date),
                'delivery_date' => date_create($request->delivery_date),
                'boilermaker' => $request->boilermaker,
                'completed' => $request->completed
            ]);
        return;
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return;
    }

    public function urgent()
    {
        return DB::table('Jobs')
            ->where('deadline_date', '<', Carbon::now())->get();
    }
}
