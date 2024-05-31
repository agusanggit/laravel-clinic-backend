<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PatientSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PatientScheduleController extends Controller
{
    //index
    public function index(Request $request)
    {

        //get all patient schedule paginated
        //search patient schedule by name
        $patientSchedule = DB::table('patient_schedules')
            ->when($request->input('patient_id'), function ($query, $name) {
                return $query->where('patient_id', 'like', '%' . $name . '%');
            })
            ->orderBy('id', 'desc')
            // ->paginate(10);
            //get all
            ->get();
        //return json 200
        //return response()->json($doctors, 200);
        //return dengan key data
        return response([
            'data' => $patientSchedule,
            'message' => 'Success',
            'status' => 'Ok'
        ], 200);
    }

    //store
    public function store(Request $request)
    {
        //validate incoming request
        $request->validate ([
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'schedule_time' => 'required',
            'complaint' => 'required',
            'status' => 'required',
        ]);

        //store patient schedule
        // $patientSchedule = DB::table('patient_schedules') -> insertGetId ([
        $patientSchedule = PatientSchedule::create([
            'patient_id' => $request -> patient_id,
            'doctor_id' => $request -> doctor_id,
            'schedule_time' => $request -> schedule_time,
            'complaint' => $request -> complaint,
            'status' => 'waiting',
            'no_antrian' => 1,
            // 'payment_method' => $request -> payment_method,
            // 'total_price' => $request -> total_price,

        ]);

        return response ([
            'data' => $patientSchedule,
            'message' => 'Patient schedule stored',
            'status' => 'OK',
        ], 200);
    }
}
