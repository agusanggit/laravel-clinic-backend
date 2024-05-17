<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DoctorSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DoctorScheduleController extends Controller
{
    //index
    public function index(Request $request)
    {
        // index
        // get All doctor schedule just schedule
        // $schedule = DB::table('doctor_schedules')
        // with doctor table
        $schedule = DoctorSchedule::with('doctor')
        // ->join('doctors','doctor_schedules.doctor_id','=','doctors.id')
        // ->select('doctor_schedules.*', 'doctors.*')
        ->when($request->input('name'), function ($query, $doctor_name){
            return $query->whereHas('doctor', function ($query) use ($doctor_name){
                return $query->where('doctor_name', 'like', '%' . $doctor_name . '%');
            });
        })
        ->orderBy('id', 'desc')
        // ->orderBy('doctor_schedules.id', 'desc')
        //->paginate(10);
        //get all
        ->get();
        //return json 200
        //return response()->json($doctors, 200);
        //return dengan key data
        return response ([
            'status' => 'Success',
            'data' => $schedule,
            'message' => 'Doctor schedule retrieved successfully',
        ], 200);
    }
}
