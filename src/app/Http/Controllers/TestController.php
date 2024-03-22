<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Test;
use \Illuminate\Support\Facades\DB;

class TestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }



    public function getindex()
    {
        $test = DB::table('tests')->paginate('100');
        return view('test.index', compact('test'));
    }


    public function index()
    {  
        $vendors = Test::select('vendor')
            ->groupBy('vendor')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(100)
            ->pluck('vendor');

       
        $test = Test::paginate(100);
        return view('test.vendor', compact('test', 'vendors'));
    }
}
