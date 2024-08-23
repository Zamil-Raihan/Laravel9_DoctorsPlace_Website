<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use App\Models\Doctor;

class DoctorController extends Controller
{
    public function index(Request $request){
        $search = $request->input('search');
        $doctors = Doctor::when($search, function ($query) use ($search) {
            $query->where('id', 'like', '%' . $search . '%')
                  ->orWhere('name', 'like', '%' . $search . '%')
                  ->orWhere('branch', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('degree', 'like', '%' . $search . '%');
        })->orderBy('id','ASC')->get();
        return view('doctor.list_admin',['doctors' => $doctors, 'search' => $search]);
    }
    
    public function index_public(Request $request){
        $search = $request->input('search');
        $doctors = Doctor::when($search, function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('branch', 'like', '%' . $search . '%');
        })->orderBy('name','ASC')->get();
        return view('doctor.list_public',['doctors' => $doctors, 'search' => $search]);
    }

    public function create(){
        return view ('doctor.create');
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'degree' => 'required',
            'branch' => 'required',
            'working_place' => 'required',
            'email' => 'required',
            'call_for_serial' => 'required',
            'image' => 'sometimes|image:jpg,jpeg,png,bmp',
        ]);
        if( $validator->passes()){
            //save
            $doctor = new Doctor();
            $doctor->name = $request->name;
            $doctor->degree = $request->degree;
            $doctor->branch = $request->branch;
            $doctor->working_place = $request->working_place;
            $doctor->email = $request->email;
            $doctor->call_for_serial = $request->call_for_serial;
            $doctor->save();
            //imageUpload
            if($request->image){
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/doctors',$newFileName);
                $doctor->image = $newFileName;
                $doctor->save();
            }
            $request->session()->flash('success','Information Successfully Added...!');
            return redirect()->route('doctors.index');
            
        }else{
            //error
            return redirect()->route('doctors.create')->withErrors($validator)->withInput();
        }
    }

    public function edit($id){
        $doctor = Doctor::findOrFail($id);
        return view('doctor.edit', ['doctor' => $doctor]);
    }

    public function update($id, Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'degree' => 'required',
            'branch' => 'required',
            'working_place' => 'required',
            'email' => 'required',
            'call_for_serial' => 'required',
            'image' => 'sometimes|image:jpg,jpeg,png,bmp',
        ]);
        if( $validator->passes()){
            //save
            $doctor = Doctor::find($id);
            $doctor->name = $request->name;
            $doctor->degree = $request->degree;
            $doctor->branch = $request->branch;
            $doctor->working_place = $request->working_place;
            $doctor->email = $request->email;
            $doctor->call_for_serial = $request->call_for_serial;
            $doctor->save();
            //imageUpload
            if($request->image){
                $oldImage = $doctor->image;
                $ext = $request->image->getClientOriginalExtension();
                $newFileName = time().'.'.$ext;
                $request->image->move(public_path().'/uploads/doctors',$newFileName);
                $doctor->image = $newFileName;
                $doctor->save();
                File::delete(public_path().'/uploads/doctors'.$oldImage);
            }
            $request->session()->flash('success','Information Successfully Edited...!');
            return redirect()->route('doctors.index');
            
        }else{
            //error
            return redirect()->route('doctors.edit',$id)->withErrors($validator)->withInput();
        }
    }

    public function destroy($id, Request $request){
        $doctor = Doctor::findOrFail($id);
        File::delete(public_path().'/uploads/doctors/'.$doctor->image);
        $doctor->delete();
        $request->session()->flash('success','Information deleted successfully...!');
        return redirect()->route('doctors.index');
    }
}
