<?php

namespace App\Http\Controllers;

use App\Quote;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        $data = request()->validate([
            'searchTerm' => 'required'
        ]);

        return Quote::search($data['searchTerm'])->get();
    }
}
