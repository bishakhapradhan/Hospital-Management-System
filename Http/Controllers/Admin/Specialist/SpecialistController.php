<?php

namespace App\Http\Controllers\Admin\Specialist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\specialist;


class SpecialistController extends Controller
{
    public function create(){
        return view('admin.specialist.create');
    }
    public function index(){
        $specialists=Specialist::get();//$categories to fetch all data
        return view('admin.specialist.index',compact('specialists'));
    }
    public function edit($id){
        $specialist=Specialist::find($id);
        return view('admin.specialist.edit',compact('specialist'));
    }
    public function store(Request $request){//submit grdako request catch grxa
        // dd($request->all());
        // return view('admin.category.store');
        $specialist=new Specialist();
        $specialist->SpecialistType=$request->get('SpecialistType');
        $specialist->description=$request->get('description');
        $specialist->is_active=$request->get('is_active')==true?1:0;
        $specialist->save();
        return redirect()->route('specialist.index');

    }
    public function update($id,Request $request){
        $specialist=Specialist::find($id);
        $specialist->SpecialistType=$request->get('SpecialistType');
        $specialist->description=$request->get('description');
        $specialist->is_active=$request->get('is_active')==true?1:0;
        $specialist->save();
        return redirect()->route('specialist.index');

    }
    public function delete($id){
        $specialist=Specialist::find($id);
        $specialist->delete();
        return redirect()->route('specialist.index');
    }

}


