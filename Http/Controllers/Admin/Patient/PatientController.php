<?php

namespace App\Http\Controllers\Admin\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Carbon;

class PatientController extends Controller
{
    public $uploadPath="uploads1/user1";
    public function index(){
        $patients=Patient::get();
        return view('admin.patient.index',compact('patients'));
    }
    public function create(){
        $patients=Patient::get();
        return view('admin.patient.create', compact('patients'));
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
        $patient=new Patient();
        $patient->Name=$request->get('name');
        $patient->description=$request->get('description');
        $patient->contact=$request->get('contact');
        $patient->address=$request->get('address');
        $patient->age=$request->get('age');
        $patient->image=$fileName;
        $patient->save();
        return redirect()->route('patient.index');
    }
    public function edit($id){
        $patient=Patient::find($id);
        return view('admin.patient.edit',compact('patient'));
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
        $patient=new Patient();
        $patient->Name=$request->get('name');
        $patient->description=$request->get('description');
        $patient->contact=$request->get('contact');
        $patient->address=$request->get('address');
        $patient->age=$request->get('age');
        $patient->image=$fileName;
        $patient->save();
        return redirect()->route('patient.index');

    }
    public function delete($id){
        $patient=Patient::find($id);
        if(!empty($patient))
        $patient->delete();
        return redirect()->route('patient.index');
    }
}


