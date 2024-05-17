<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ServiceMedicinesController extends Controller
{
    //index
    public function index(Request $request)
    {

        //get all service medicines paginated
        //search service medicines by name
        $service_medicines = DB::table('service_medicines')
            ->when($request->input('name'), function ($query, $name) {
                return $query->where('name', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            //->paginate(10);
            //get all
            ->get();
        //return json 200
        //return response()->json($doctors, 200);
        //return dengan key data
        return response([
            'data' => $service_medicines,
            'message' => 'Success',
            'status' => 'Ok'
        ], 200);
    }
}
