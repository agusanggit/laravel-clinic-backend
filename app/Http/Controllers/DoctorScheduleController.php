<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DoctorSchedule;
use Illuminate\Support\Facades\DB;
//menambahkan models Doctor
use App\Models\Doctor;

class DoctorScheduleController extends Controller
{
    //index
    public function index(Request $request)
    {
        //index
        // $doctorSchedule = DB::table('doctor_schedules')
        // a load dari table doctor
        $doctorSchedules = DoctorSchedule::with('doctor')
            ->when($request->input('doctor_id'), function ($query, $doctor_id) {
                return $query->where('doctor_id', $doctor_id);
            })

            // order by doctor_name
            ->orderBy('doctor_id', 'asc')
            // order by id
            // ->orderBy('id', 'desc')
            //tambahkan load doctor
            // ->load('doctor')
            ->paginate(10);
        return view('pages.doctor_schedules.index', compact('doctorSchedules'));
    }

    //create
    public function create()
    {
        return view('pages.doctor_schedules.create');
    }

    //store
    public function store(Request $request)
    {
        $doctorSchedule = new DoctorSchedule;
        $doctorSchedule->doctor_id = $request->doctor_id;
        $doctorSchedule->day = $request->day;
        $doctorSchedule->time = $request->time;
        $doctorSchedule->status = $request->status;
        $doctorSchedule->note = $request->note;
        $doctorSchedule->save();

        return redirect()->route('doctor-schedules.index')->with('success', 'Doctor Schedule Created Successfully.');
    }

    //edit
    public function edit($id)
    {
        $doctorSchedule = DoctorSchedule::find($id);
        $doctor = Doctor::all();
        return view('pages.doctor_schedules.edit', compact('doctorSchedule', 'doctors'));
    }

    //update
    public function update(Request $request, $id)
    {
        $request->validate([
            'doctor_id' => 'required',
            'day' => 'required',
            'time' => 'required',

        ]);

        $doctorSchedule = DoctorSchedule::find($id);
        $doctorSchedule->doctor_id = $request->doctor_id;
        $doctorSchedule->day = $request->day;
        $doctorSchedule->time = $request->time;
        $doctorSchedule->status = $request->status;
        $doctorSchedule->note = $request->note;
        $doctorSchedule->save();

        return redirect()->route('doctor-schedules.index')->with('success',
        'Doctor Schedule Updated Successfully.');
    }

    //destroy
    public function destroy($id)
    {
       DoctorSchedule::find($id)->delete();

       return redirect()->route('doctor-schedules.index')->with('success', 'Doctor Schedule Deleted Successfully.');
    }
}
