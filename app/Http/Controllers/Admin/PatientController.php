<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;

class PatientController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function  getPatient() {

        $patient = Patient::select()->orderBy('id', 'desc')->paginate(20);
        return view('admin.patient.home', compact('patient'));
    }

    public function storePatient(Request $request) {


        $validation = Validator::make($request->all(), [
            'name' => 'required|max:190',
            'password' => 'required|max:190',
            'email' => 'required|email|unique:patients',
            'age' => 'required',
            'gender' => 'required',
        ]);


        if($validation -> fails()) {
            return redirect()->back()->withErrors($validation)->withInput($request->all());
        }

        $store = Patient::create([
            'name' => $request -> name,
            'password' => Hash::make($request->password),
            'email' => $request -> email,
            'age' => $request -> age,
            'gender' => $request -> gender,
        ]);

        if ($store) {

            $notification = array(
                'message' => __('site.messageAdded'),
                'alert-type' => 'success'
            );
            return Redirect()->route('admin.home')->with($notification);
        }else{
            $notification = array(
                'message' => __('site.failed'),
                'alert-type' => 'error'
            );
            return Redirect()->route('admin.home')->with($notification);
        }

    }

    public function deletePatient($id) {
        // Cheak if Correct Url
        $PatDelete = Patient::find($id); // search in data base with id only

        if (!$PatDelete)
            return redirect()->back();

        $deletePa = $PatDelete->delete();

        if ($deletePa) {

            $notification = array(
                'message' => __('site.messageDelete'),
                'alert-type' => 'success'
            );
            return Redirect()->route('admin.home')->with($notification);
        }else{
            $notification = array(
                'message' => __('site.failed'),
                'alert-type' => 'error'
            );
            return Redirect()->route('admin.home')->with($notification);
        }
    }


    public function editPatient($id) {

        $editIdPat = Patient::find($id);
        if (!$editIdPat)
            return redirect()->back();

        $patInfo = Patient::select()->where('id', $id)->first();
        return view('admin.patient.edit', compact('patInfo'));


    }


    public function updatePatient(Request $request, $id) {
        $editIdPat = Patient::find($id);
        if (!$editIdPat)
            return redirect()->back();

        $validation = Validator::make($request->all(), [
            'name' => 'required|max:190',
            'password' => 'max:190',
            'email' => 'required|email',
            'age' => 'required',
            'gender' => 'required',
        ]);

        if($validation -> fails()) {
            return redirect()->back()->withErrors($validation)->withInput($request->all());
        }




        $newPassword = '';

        if (trim($request->password) == '') {
            $newPassword = $request->old_password;
        }else{
            $newPassword = Hash::make($request->password);
        }

        $updatePat = $editIdPat->update([
            'name' => $request -> name,
            'password' => $newPassword,
            'email' => $request -> email,
            'age' => $request -> age,
            'gender' => $request -> gender,
        ]);

        if ($updatePat) {

            $notification = array(
                'message' => __('site.messageUpdate'),
                'alert-type' => 'success'
            );
            return Redirect()->route('admin.home')->with($notification);
        }else{
            $notification = array(
                'message' => __('site.failed'),
                'alert-type' => 'error'
            );
            return Redirect()->route('admin.home')->with($notification);
        }


    }
}
