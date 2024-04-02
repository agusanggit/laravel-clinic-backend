<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{

    public function index(Request $request)
    {
        //index
        $doctors = DB::table('doctors')
        ->when($request->input('name'), function ($query, $doctor_name) {
            return $query->where('doctor_name', 'like', '%' . $doctor_name . '%');
        })
        ->orderBy('id', 'desc')
        ->paginate(10);
        return view('pages.doctors.index', compact('doctors'));
    }

    //create
    public function create(){
        return view('pages.doctors.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate ([
            'doctor_name' => 'required',
            'doctor_specialist' => 'required',
            'doctor_phone' => 'required',
            'doctor_email' => 'required|email',
            'sip' => 'required',
            'id_ihs' => 'required',
            'nik' => 'required',
        ]);


        // DB::table('doctors')->insert([
        //     'doctor_name' => $request->doctor_name,
        //     'doctor_specialist' => $request->doctor_specialist,
        //     'doctor_phone' => $request->doctor_phone,
        //     'doctor_email' => $request->doctor_email,
        //     'address' => $request->address,
        //     'sip' => $request->sip,
        //     'id_ihs' => $request->id_ihs,
        //     'nik' => $request->nik,
        // ]);

        $doctor = new Doctor();
        $doctor->doctor_name = $request->doctor_name;
        $doctor->doctor_specialist = $request->doctor_specialist;
        $doctor->doctor_phone = $request->doctor_phone;
        $doctor->doctor_email = $request->doctor_email;
        $doctor->address = $request->address;
        $doctor->sip = $request->sip;
        $doctor->id_ihs = $request->id_ihs;
        $doctor->nik = $request->nik;
        $doctor->save();

        // //if image exist save to public/images
        // if ($request->file('photo')){
        //     //diambil dulu fotonya
        //     $photo = $request->file('photo');
        //     // dibuat namanya
        //     $photo_name = time().'.'.$photo->extension();
        //     // kemudian di move
        //     $photo->move(public_path('images'),$photo_name);
        //     //Diisi nama filenya dan diupdate
        //     DB::table('doctors')->where('id', DB::getPdo()->lastInsertId())->update(['photo'=>$photo_name
        // ]);
    // }

    if ($request->hasFile('photo')){
            //diambil dulu fotonya
            $image = $request->file('photo');
            // dibuat folder
            $image->storeAs('public/doctors/', $doctor->id.'.'.$image->getClientOriginalExtension());
            // kemudian di save pada storage
            $doctor->photo = 'storage/doctors/'. $doctor->id.'.'.$image->getClientOriginalExtension();
            //Kemudian di save
            $doctor->save();

    }
        return redirect()->route('doctors.index')->with('success', 'Doctor Created Successfully.');
    }

     //show
     public function show($id)
     {
        $doctor = DB::table('doctors')->where('id',$id)->first();
        return view('pages.doctors.show', compact('doctor'));
    }

    //edit
    public function edit($id)
    {
        // $doctor = DB::table('doctors')->where('id',$id)->first();
        $doctor = Doctor::find($id);
        return view('pages.doctors.edit', compact('doctor'));
    }

     //update
     public function update(Request $request, $id)
     {
        $request->validate ([
            'doctor_name' => 'required',
            'doctor_specialist' => 'required',
            'doctor_phone' => 'required',
            'doctor_email' => 'required|email',
            'photo' => 'required',
            'address' => 'required',
            'sip' => 'required',
            'id_ihs' => 'required',
            'nik' => 'required',
        ]);

        // DB::table('doctors')->where('id', $id)->update([
        //     'doctor_name' => $request->doctor_name,
        //     'doctor_specialist' => $request->doctor_specialist,
        //     'doctor_phone' => $request->doctor_phone,
        //     'doctor_email' => $request->doctor_email,
        //     'address'=> $request->address,
        //     'sip' => $request->sip,
        //     'id_ihs' => $request->id_ihs,
        //     'nik' => $request->sip,

        // ]);

        $doctor = Doctor::find($id);
        $doctor->doctor_name = $request->doctor_name;
        $doctor->doctor_specialist = $request->doctor_specialist;
        $doctor->doctor_phone = $request->doctor_phone;
        $doctor->doctor_email = $request->doctor_email;
        $doctor->address = $request->address;
        $doctor->sip = $request->sip;
        $doctor->id_ihs = $request->id_ihs;
        $doctor->nik = $request->nik;
        $doctor->save();

        if ($request->hasFile('photo')){
            //diambil dulu fotonya
            $image = $request->file('photo');
            // dibuat folder
            $image->storeAs('public/doctors/', $doctor->id.'.'.$image->getClientOriginalExtension());
            // kemudian di save pada storage
            $doctor->photo = 'storage/doctors/'. $doctor->id.'.'.$image->getClientOriginalExtension();
            //Kemudian di save
            $doctor->save();

    }

         return redirect()->route('doctors.index')->with('success', 'Doctor Updated Successfully.');
     }

     //destroy
     public function destroy($id)
     {
        DB::table('doctors')->where('id', $id)->delete();

        return redirect()->route('doctors.index')->with('success', 'Doctor Deleted Successfully.');
     }

}
