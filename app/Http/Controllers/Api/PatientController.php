<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{

    //index
    public function index(Request $request)
    {

        //get all patients paginated
        //search patients by nik
        $patients = DB::table('patients')
            ->when($request->input('nik'), function ($query, $name) {
                return $query->where('nik', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            //->paginate(10);
            //get all
            ->get();
        //return json 200
        //return response()->json($doctors, 200);
        //return dengan key data
        return response([
            'data' => $patients,
            'message' => 'Success',
            'status' => 'Ok'
        ], 200);
    }
}
