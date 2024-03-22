<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class SearchController extends Controller
{


    public function searchVendors(Request $request)
    {
        $vendors = Test::select('vendor');

        // เพิ่มตัวเลือกที่ถูกเลือกไปด้วย
        $vendors = Test::select('vendor')
            ->groupBy('vendor')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(100)
            ->pluck('vendor');

        return response()->json($vendors);
    }

    
    public function searchPrefix(Request $request)
    {
        $prefix = $request->input('search_prefix');
        $results = Test::where('mac_prefix', 'LIKE', "%{$prefix}%")->get();
        return response()->json($results);
    }
}
