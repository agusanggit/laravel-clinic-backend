<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientController extends Controller
{
    //index
    public function index(Request $request)
    {
        //search patients by nik second methode
        $patients = DB::table('patients')
        ->when($request->input('nik'), function ($query, $name) {
            return $query->where('nik', 'like', '%' . $name . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        //search patients by nik first methode
        // if($request->nik){
        //     $patients = \App\Models\Patient::where('nik', 'like', '%' . $request->nik . '%')->paginate(10);
        // }else{
        //     $patients = \App\Models\Patient::paginate(10);
        // }
        // get all patient and pagination
        // $patients = \App\Models\Patient::paginate(10);
        return view('pages.patients.index', compact('patients'));
    }
}
