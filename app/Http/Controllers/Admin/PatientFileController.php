<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\PatientFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use function MongoDB\BSON\toJSON;
use function PHPUnit\Framework\isEmpty;

class PatientFileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function getPatientFile() {
        $patientName = Patient::select()->orderBy('name', 'desc')->get();
        $patient = PatientFile::join('patients', 'patient_files.patient_id', 'patients.id')
            ->select('patients.name','patients.id as idP', 'patient_files.*')
            ->orderBy('patient_files.id', 'desc')->paginate(20);


        return view('admin.patient.add-file-patient', compact('patient','patientName'));
    }

    public function storePatientFile(Request $request) {

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'picture' => 'mimes:jpeg,png,jpg,pdf,docx|max:2048',
        ]);

        if($validation -> fails()) {
            return redirect()->back()->withErrors($validation)->withInput($request->all());
        }

        $fileName = '';
        $state = 1;

        $file = $request->file('picture');
        if ($file) {
            $image_name = date('dmy_H_s_i'.rand());
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext == 'pdf' || $ext == 'docx') {
                $upload_path = 'assets/file/other/';
            }else {
                $upload_path = 'assets/file/image/patient/';
            }

            $image_full_name = $image_name.'.'.$ext;
            $image_url = $upload_path.$image_full_name;
            $file->move($upload_path,$image_full_name);

            $fileName = $image_url;

        }

        if ($fileName != '') {
            $state = 2; // State 2 meaning Done , 1 Not Done
        }

        $store = PatientFile::create([
            'patient_id' => $request -> name,
            'file' => $fileName,
            'state' => $state,
        ]);

        if ($store) {

            $notification = array(
                'message' => __('site.messageAdded'),
                'alert-type' => 'success'
            );
            return Redirect()->route('admin.patient.file')->with($notification);
        }else{
            $notification = array(
                'message' => __('site.failed'),
                'alert-type' => 'error'
            );
            return Redirect()->route('admin.patient.file')->with($notification);
        }
    }


    public function deletePatientFile($id) {

        $PatDelete = PatientFile::find($id); // search in data base with id only

        if (!$PatDelete)
            return redirect()->back();


        //For Delete File
        $data2 = DB::table('patient_files')->where('id',$id)->first();
        $file = $data2->file;
        if ($file != "") {
            unlink($file);
        }

        //For Delete Patient-File
        $deletePa = $PatDelete->delete();

        if ($deletePa) {
            $notification = array(
                'message' => __('site.messageDelete'),
                'alert-type' => 'success'
            );
            return Redirect()->route('admin.patient.file')->with($notification);
        }else{
            $notification = array(
                'message' => __('site.failed'),
                'alert-type' => 'error'
            );
            return Redirect()->route('admin.patient.file')->with($notification);
        }
    }

    public function editPatientFile($id) {

        $editIdPat = PatientFile::find($id);
        if (!$editIdPat)
            return redirect()->back();
        $patientName = Patient::select()->orderBy('name', 'desc')->get();

        $patInfo = PatientFile::select()->where('id', $id)->first();
        return view('admin.patient.edit-file-patient', compact('patInfo', 'patientName'));

    }


    public function updatePatientFile($id, Request $request) {
        $editIdPat = PatientFile::find($id);
        if (!$editIdPat)
            return redirect()->back();

        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'picture' => 'mimes:jpeg,png,jpg,pdf,docx|max:2048',
        ]);

        if($validation -> fails()) {
            return redirect()->back()->withErrors($validation)->withInput($request->all());
        }


        $fileName = '';
        $file = $request->file('picture');
        $old_file = $request->old_file;
        $state = 1;
        if ($file) {
            $image_name = date('dmy_H_s_i'.rand());
            $ext = strtolower($file->getClientOriginalExtension());

            if ($ext == 'pdf' || $ext == 'docx') {
                $upload_path = 'assets/file/other/';
            }else {
                $upload_path = 'assets/file/image/patient/';
            }

            $image_full_name = $image_name.'.'.$ext;
            $image_url = $upload_path.$image_full_name;
            $file->move($upload_path,$image_full_name);

            $fileName = $image_url;

            $state = 2;
            if ($old_file != '') {
                unlink($old_file); // Delete Old File
            }


        }else {

            if($old_file != '') {
                $fileName = $old_file;
                $state = 2;
            }else {
                $fileName = '';
                $state = 1;
            }
        }

        $updatePat = $editIdPat->update([
            'patient_id' => $request->name,
            'file' => $fileName,
            'state' => $state,

        ]);

        if ($updatePat) {

            $notification = array(
                'message' => __('site.messageUpdate'),
                'alert-type' => 'success'
            );
            return Redirect()->route('admin.patient.file')->with($notification);
        }else{
            $notification = array(
                'message' => __('site.failed'),
                'alert-type' => 'error'
            );
            return Redirect()->route('admin.patient.file')->with($notification);
        }

    }
}
