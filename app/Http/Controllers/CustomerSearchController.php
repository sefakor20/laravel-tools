<?php

namespace App\Http\Controllers;

use App\Models\CustomerSearch;
use Illuminate\Http\Request;
use DB;

class CustomerSearchController extends Controller
{
    function index(Request $request)
    {
        if(request()->ajax()) {
            if (!empty($request->filter_gender)) {
                $data = DB::table('customer_searches')
                        ->select('CustomerName', 'Gender', 'Address', 'City', 'PostalCode', 'Country')
                        ->where('Gender', $request->filter_gender)
                        ->where('Country', $request->filter_country)
                        ->get();

            } else {
                $data = DB::table('customer_searches')
                        ->select('CustomerName', 'Gender', 'Address', 'City', 'PostalCode', 'Country')
                        ->get();

            }
            return datatables()->of($data)->make(true);
        }

        $country_name = DB::table('customer_searches')
                        ->select('Country')
                        ->groupBy('Country')
                        ->orderBy('id', 'ASC')
                        ->get();
        return view('customsearch', compact('country_name'));
    }
}
