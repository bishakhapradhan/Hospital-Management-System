<?php

namespace App\Http\Controllers\Admin\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\specialist;
use Illuminate\Support\Carbon;


class DoctorController extends Controller
{

    public $uploadPath="uploads/user";
    public function index(){
        $doctors=Doctor::get();
        return view('admin.doctor.index',compact('doctors'));
    }
    public function create(){
        $specialists = specialist::get();
        return view('admin.doctor.create', compact('specialists'));
    }
    public function store(Request $request){
        // $rules=array{
        //     'SpecialistType' => 'required',
        // };
        // $request->validate($rules);
        $fileName=null;
        if($request->file('image')){
        $fileName=strtotime(Carbon::now());
         $fileName= $fileName.".".$request->file('image')->extension();
        $uploadPath=(public_path($this->uploadPath."/".$fileName));
         move_uploaded_file($request->file('image'), $uploadPath);

        }
        $doctor=new Doctor();
        $doctor->Name=$request->get('name');
        $doctor->specialist_id=$request->get('specialist_id');
        $doctor->description=$request->get('description');
        $doctor->PhoneNumber=$request->get('phonenumber');
        $doctor->image=$fileName;
        $doctor->save();
        return redirect()->route('doctor.index');
    }
    public function edit($id){
        $doctor=Doctor::find($id);
        return view('admin.doctor.edit',compact('doctor'));
    }
    public function update($id,Request $request){
        //  dd($request->all());
        $fileName=null;
        if($request->file('image')){
        $fileName=strtotime(Carbon::now());
         $fileName= $fileName.".".$request->file('image')->extension();
        $uploadPath=(public_path($this->uploadPath."/".$fileName));
         move_uploaded_file($request->file('image'), $uploadPath);

        }
        $doctor=Doctor::find($id);
        $doctor->Name=$request->get('name');
        $doctor->specialist_id=$request->get('specialist_id');
        $doctor->description=$request->get('description');
        $doctor->PhoneNumber=$request->get('phonenumber');
        $doctor->image=$fileName;
        $doctor->save();
        return redirect()->route('doctor.index');

    }
    public function delete($id){
        $doctor=Doctor::find($id);
        if(!empty($doctor))
        $doctor->delete();
        return redirect()->route('doctor.index');
    }
}
