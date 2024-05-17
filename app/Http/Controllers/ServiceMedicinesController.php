<?php

namespace App\Http\Controllers;

use App\Models\ServiceMedicines;
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
            ->paginate(10);
            //get all
            // ->get();
            return view('pages.service_medicines.index', compact('service_medicines'));

    }

    //create
    public function create(){
        return view('pages.service_medicines.create');
    }

    //store
    public function store(Request $request)
    {
        $request->validate ([
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $service_medicines = ServiceMedicines::create($request->all());

        return redirect()->route('service-medicines.index')->with('success', 'Service Medicine Created Successfully.');
    }

    //edit
    public function edit($id){

        $service_medicines = ServiceMedicines::find($id);
        return view('pages.service_medicines.edit', compact('service_medicines'));

    }

    //update
    public function update(Request $request, $id){

        $this->validate ($request, [
            'name' => 'required',
            'category' => 'required',
            'price' => 'required',
            'quantity' => 'required',
        ]);

        $service_medicines = ServiceMedicines::find($id);
        $service_medicines -> update($request->all());

        return redirect()->route('service-medicines.index')->with('success', 'Service Medicine Updated Successfully.');

    }


    //destroy
    public function destroy($id)
    {

        $service_medicines = ServiceMedicines::find($id);
        $service_medicines -> delete();

        return redirect()->route('service-medicines.index')->with(
            'success', 'Service Medicine Delete Successfully.');
    }


}
