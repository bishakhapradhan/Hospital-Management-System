<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\staff;

class StaffController extends Controller
{
    //
    public function create(){
        return view('admin.staff.create');
    }
    public function index(){
        $staff=staff::get();//$categories to fetch all data
        return view('admin.staff.index',compact('staff'));
    }
    public function edit($id){
        $staff=staff::find($id);
        return view('admin.staff.edit',compact('staff'));
    }
    public function store(Request $request){//submit grdako request catch grxa
        // dd($request->all());
        // return view('admin.category.store');
        $staff=new staff();
        $staff->name=$request->get('name');
        $staff->age=$request->get('age');
        $staff->qualification=$request->get('qualification');
        $staff->salary=$request->get('salary');
        $staff->address=$request->get('address');
        $staff->post=$request->get('post');

        $staff->save();
        return redirect()->route('staff.index');

    }
    public function update($id,Request $request){
        $staff=staff::find($id);

        //dd($request->all());
        $staff->name=$request->get('name');
        $staff->age=$request->get('age');
        $staff->qualification=$request->get('qualification');
        $staff->salary=$request->get('salary');
        $staff->address=$request->get('address');
        $staff->post=$request->get('post');
        $staff->save();
        return redirect()->route('staff.index');

    }
    public function delete($id){
        $staff=staff::find($id);
        $staff->delete();
        return redirect()->route('staff.index');
    }

}
