<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\appointment as ModelsAppointment;

class AppointmentController extends Controller
{
    public function appointform()
    {
        if(auth()->check())
        return redirect()->route('dashboard');
        return view('admin.auth.appointform');
    }
    //
    public function showappointment()
    {
        $data=appointment::all();
        return view('admin.appointment.index',compact('data'));
    }
    public function aprroved(Request $request)
    {
        dd($request->get('id'));
    //    $data=appointment::find($id);

    //    $data->status='approved';
    //    $data->save();
       return redirect()->back;
    }
    public function appointment(Request $request)

        {
             $data=new appointment;
        //    $data->Name=$request->Name;
        //     $data->Email=$request->Email;
        //     $data->subject=$request->subject;

        //     $data->Phone=$request->Phone;
        //     $data->Date=$request->Date;
        //     $data->Category=$request->Category;
        //     $data->form_message=$request->form_message;
            $progress="inprogress";
            $data->Name=$request->get('Name');
            $data->Email=$request->get('Email');
            $data->subject=$request->get('subject');
            $data->Phone=$request->get('Phone');
            $data->Date=$request->get('Date');
            $data->Category=$request->get('Category');
            $data->form_message=$request->get('form_message');
            $data->Status;






             if($data->save())
             {
                 return redirect('/layouts1')->with(['msg'=>"User create successfully"]);
                return redirect()->route('auth.appointment')->withError(['msg'=>"User cannot be registered at the moment"]);
             }



        }

        public function aprrovPatient($id){
            $appointment = Appointment::find($id);
            $appointment->status = "approved";
            $appointment->save();
            return redirect()->route('showappointment');
        }
        public function cancelPatient($id){
            $appointment = Appointment::find($id);
            $appointment->status = "cancelled";
            $appointment->save();
            return redirect()->route('showappointment');
        }


}
