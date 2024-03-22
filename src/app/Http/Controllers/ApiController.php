<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class ApiController extends Controller
{
    public function getData()
    {
        $test = Test::all();
        return response()->json($test);
    }
}
