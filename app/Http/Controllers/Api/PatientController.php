<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Patient;
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

    //store
    public function store(Request $request)
    {
        $request->validate ([
        'nik' => 'required',
        'kk' => 'required',
        'name' => 'required',
        'phone' => 'required',
        'gender' => 'required',
        'birth_place' => 'required',
        'birth_date' => 'required',
        'is_deceased' => 'required',
        'address_line' => 'required',
        'city' => 'required',
        'city_code' => 'required',
        'province' => 'required',
        'province_code' => 'required',
        'district' => 'required',
        'district_code' => 'required',
        'village' => 'required',
        'village_code' => 'required',
        'rt' => 'required',
        'rw' => 'required',
        'postal_code' => 'required',
        'marital_status' => 'required',

    ]);
    // store patient
    $patient = Patient::create($request->all());

    return response ([
        'data' => $patient,
        'message' => 'Patient created.',
        'status' => 'OK',
    ], 201);

    }
}
